<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTechnologyProjectRequest;
use App\Models\TechnologyProject;
use App\Models\TechnologyMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TechnologyProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = TechnologyProject::query()->with('media');

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sector', 'like', "%{$search}%");
            });
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $projects = $query->latest()->paginate(10)->withQueryString();

        return view('admin.technology.index', compact('projects'));
    }

    public function create()
    {
        $defaultImages = $this->getDefaultImages();

        return view('admin.technology.form', ['project' => new TechnologyProject(), 'defaultImages' => $defaultImages]);
    }

    public function store(StoreTechnologyProjectRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']) . '-' . uniqid();
        $data['is_featured'] = $request->boolean('is_featured');
        $data['created_by'] = auth()->id();

        $project = TechnologyProject::create($data);

        $this->storeMedia($project, $request);
        $this->attachDefaultImage($project, $request);

        return redirect()->route('admin.technology.index')
            ->with('success', 'Technology project created successfully.');
    }

    public function edit(TechnologyProject $technologyProject)
    {
        $defaultImages = $this->getDefaultImages();

        return view('admin.technology.form', ['project' => $technologyProject, 'defaultImages' => $defaultImages]);
    }

    public function update(StoreTechnologyProjectRequest $request, TechnologyProject $technologyProject)
    {
        $data = $request->validated();
        $data['is_featured'] = $request->boolean('is_featured');

        if ($data['name'] !== $technologyProject->name) {
            $data['slug'] = Str::slug($data['name']) . '-' . uniqid();
        }

        $technologyProject->update($data);

        $this->storeMedia($technologyProject, $request);
        $this->attachDefaultImage($technologyProject, $request);

        return redirect()->route('admin.technology.index')
            ->with('success', 'Technology project updated successfully.');
    }

    public function destroy(TechnologyProject $technologyProject)
    {
        $technologyProject->delete();

        return redirect()->route('admin.technology.index')
            ->with('success', 'Technology project deleted successfully.');
    }

    public function destroyMedia(TechnologyMedia $media)
    {
        Storage::disk('public')->delete($media->path);
        $media->delete();

        return back()->with('success', 'Media removed.');
    }

    protected function getDefaultImages(): array
    {
        $path = public_path('images/defaults/technology');

        if (! is_dir($path)) {
            return [];
        }

        return collect(scandir($path))
            ->reject(fn ($file) => in_array($file, ['.', '..']))
            ->filter(fn ($file) => preg_match('/\.(jpg|jpeg|png|webp)$/i', $file))
            ->map(fn ($file) => 'images/defaults/technology/' . $file)
            ->values()
            ->toArray();
    }

    protected function attachDefaultImage(TechnologyProject $project, Request $request): void
    {
        $selected = $request->input('default_image');

        if (! $selected || $project->media()->count() > 0) {
            return;
        }

        $sourcePath = public_path($selected);

        if (! file_exists($sourcePath)) {
            return;
        }

        $filename = 'technology/' . uniqid() . '_' . basename($selected);
        $destination = storage_path('app/public/' . $filename);

        copy($sourcePath, $destination);

        $project->media()->create([
            'path' => $filename,
            'type' => 'image',
            'is_primary' => true,
            'sort_order' => 0,
        ]);
    }

    protected function storeMedia(TechnologyProject $project, Request $request): void
    {
        if (! $request->hasFile('media')) {
            return;
        }

        $hasPrimary = $project->media()->where('is_primary', true)->exists();

        foreach ($request->file('media') as $index => $file) {
            $path = $file->store('technology', 'public');
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
