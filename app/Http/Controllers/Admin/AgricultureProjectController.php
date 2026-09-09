<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAgricultureProjectRequest;
use App\Models\AgricultureProject;
use App\Models\AgricultureMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AgricultureProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = AgricultureProject::query()->with('media');

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $projects = $query->latest()->paginate(10)->withQueryString();

        return view('admin.agriculture.index', compact('projects'));
    }

    public function create()
    {
        $defaultImages = $this->getDefaultImages();

        return view('admin.agriculture.form', ['project' => new AgricultureProject(), 'defaultImages' => $defaultImages]);
    }

    public function store(StoreAgricultureProjectRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']) . '-' . uniqid();
        $data['is_featured'] = $request->boolean('is_featured');
        $data['created_by'] = auth()->id();

        $project = AgricultureProject::create($data);

        $this->storeMedia($project, $request);
        $this->attachDefaultImage($project, $request);

        return redirect()->route('admin.agriculture.index')
            ->with('success', 'Agriculture project created successfully.');
    }

    public function edit(AgricultureProject $agricultureProject)
    {
        $defaultImages = $this->getDefaultImages();

        return view('admin.agriculture.form', ['project' => $agricultureProject, 'defaultImages' => $defaultImages]);
    }

    public function update(StoreAgricultureProjectRequest $request, AgricultureProject $agricultureProject)
    {
        $data = $request->validated();
        $data['is_featured'] = $request->boolean('is_featured');

        if ($data['name'] !== $agricultureProject->name) {
            $data['slug'] = Str::slug($data['name']) . '-' . uniqid();
        }

        $agricultureProject->update($data);

        $this->storeMedia($agricultureProject, $request);
        $this->attachDefaultImage($agricultureProject, $request);

        return redirect()->route('admin.agriculture.index')
            ->with('success', 'Agriculture project updated successfully.');
    }

    public function destroy(AgricultureProject $agricultureProject)
    {
        $agricultureProject->delete();

        return redirect()->route('admin.agriculture.index')
            ->with('success', 'Agriculture project deleted successfully.');
    }

    public function destroyMedia(AgricultureMedia $media)
    {
        Storage::disk('public')->delete($media->path);
        $media->delete();

        return back()->with('success', 'Media removed.');
    }

    protected function getDefaultImages(): array
    {
        $path = public_path('images/defaults/agriculture');

        if (! is_dir($path)) {
            return [];
        }

        return collect(scandir($path))
            ->reject(fn ($file) => in_array($file, ['.', '..']))
            ->filter(fn ($file) => preg_match('/\.(jpg|jpeg|png|webp)$/i', $file))
            ->map(fn ($file) => 'images/defaults/agriculture/' . $file)
            ->values()
            ->toArray();
    }

    protected function attachDefaultImage(AgricultureProject $project, Request $request): void
    {
        $selected = $request->input('default_image');

        if (! $selected || $project->media()->count() > 0) {
            return;
        }

        $sourcePath = public_path($selected);

        if (! file_exists($sourcePath)) {
            return;
        }

        $filename = 'agriculture/' . uniqid() . '_' . basename($selected);
        $destination = storage_path('app/public/' . $filename);

        copy($sourcePath, $destination);

        $project->media()->create([
            'path' => $filename,
            'type' => 'image',
            'is_primary' => true,
            'sort_order' => 0,
        ]);
    }

    protected function storeMedia(AgricultureProject $project, Request $request): void
    {
        if (! $request->hasFile('media')) {
            return;
        }

        $hasPrimary = $project->media()->where('is_primary', true)->exists();

        foreach ($request->file('media') as $index => $file) {
            $path = $file->store('agriculture', 'public');
            $ext = strtolower($file->getClientOriginalExtension());
            $type = in_array($ext, ['mp4', 'webm']) ? 'video' : (in_array($ext, ['pdf']) ? 'document' : 'image');

            $project->media()->create([
                'path' => $path,
                'type' => $type,
                'is_primary' => ! $hasPrimary && $index === 0 && $type === 'image',
                'sort_order' => $project->media()->count(),
            ]);
        }
    }
}
