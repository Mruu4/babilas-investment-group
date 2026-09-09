<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePropertyRequest;
use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $query = Property::query()->with('images');

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $properties = $query->latest()->paginate(10)->withQueryString();

        return view('admin.properties.index', compact('properties'));
    }

    public function create()
    {
        $defaultImages = $this->getDefaultImages();

        return view('admin.properties.form', ['property' => new Property(), 'defaultImages' => $defaultImages]);
    }

    public function store(StorePropertyRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']) . '-' . uniqid();
        $data['is_featured'] = $request->boolean('is_featured');
        $data['created_by'] = auth()->id();
        $property = Property::create($data);
        $this->storeImages($property, $request);
        $this->attachDefaultImage($property, $request);
        return redirect()->route('admin.properties.index')
            ->with('success', 'Property created successfully.');
    }

    public function edit(Property $property)
    {
        $defaultImages = $this->getDefaultImages();

        return view('admin.properties.form', compact('property', 'defaultImages'));
    }

    public function update(StorePropertyRequest $request, Property $property)
    {
        $data = $request->validated();
        $data['is_featured'] = $request->boolean('is_featured');

        if ($data['name'] !== $property->name) {
            $data['slug'] = Str::slug($data['name']) . '-' . uniqid();
        }

        $property->update($data);

        $this->storeImages($property, $request);
        $this->attachDefaultImage($property, $request);

        return redirect()->route('admin.properties.index')
            ->with('success', 'Property updated successfully.');
    }

    public function destroy(Property $property)
    {
        $property->delete();

        return redirect()->route('admin.properties.index')
            ->with('success', 'Property deleted successfully.');
    }

    public function destroyImage(PropertyImage $image)
    {
        Storage::disk('public')->delete($image->path);
        $image->delete();

        return back()->with('success', 'Image removed.');
    }

    protected function getDefaultImages(): array
    {
        $path = public_path('images/defaults/properties');

        if (! is_dir($path)) {
            return [];
        }

        return collect(scandir($path))
            ->reject(fn ($file) => in_array($file, ['.', '..']))
            ->filter(fn ($file) => preg_match('/\.(jpg|jpeg|png|webp)$/i', $file))
            ->map(fn ($file) => 'images/defaults/properties/' . $file)
            ->values()
            ->toArray();
    }

    protected function attachDefaultImage(Property $property, Request $request): void
    {
        $selected = $request->input('default_image');

        if (! $selected || $property->images()->count() > 0) {
            return;
        }

        $sourcePath = public_path($selected);

        if (! file_exists($sourcePath)) {
            return;
        }

        $filename = 'properties/' . uniqid() . '_' . basename($selected);
        $destination = storage_path('app/public/' . $filename);

        copy($sourcePath, $destination);

        $property->images()->create([
            'path' => $filename,
            'is_primary' => true,
            'sort_order' => 0,
        ]);
    }

    protected function storeImages(Property $property, Request $request): void
    {
        if (! $request->hasFile('images')) {
            return;
        }

        $hasPrimary = $property->images()->where('is_primary', true)->exists();

        foreach ($request->file('images') as $index => $file) {
            $path = $file->store('properties', 'public');

            $property->images()->create([
                'path' => $path,
                'is_primary' => ! $hasPrimary && $index === 0,
                'sort_order' => $property->images()->count(),
            ]);
        }
    }
}
