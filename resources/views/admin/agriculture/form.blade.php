<x-layouts.admin :title="$project->exists ? 'Edit Project' : 'Add Project'">

    <div class="mb-6">
        <a href="{{ route('admin.agriculture.index') }}" class="text-sm text-gray-500 hover:text-big-navy-dark inline-flex items-center gap-1 mb-2">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to Agriculture
        </a>
        <h2 class="text-2xl font-bold text-big-navy-dark">{{ $project->exists ? 'Edit Project' : 'Add Project' }}</h2>
    </div>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-700 text-sm rounded-lg">
            <p class="font-medium mb-1">Please fix the following:</p>
            <ul class="list-disc list-inside">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form method="POST"
          action="{{ $project->exists ? route('admin.agriculture.update', $project) : route('admin.agriculture.store') }}"
          enctype="multipart/form-data" class="space-y-6">
        @csrf
        @if ($project->exists) @method('PUT') @endif

        <div class="bg-white rounded-xl border border-slate-200 p-5 sm:p-6 space-y-5">
            <h3 class="font-semibold text-slate-800">Project Information</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Project Name *</label>
                    <input type="text" name="name" value="{{ old('name', $project->name) }}" required
                           class="w-full rounded-lg border-gray-300 text-sm focus:border-big-gold focus:ring-big-gold">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Location *</label>
                    <input type="text" name="location" value="{{ old('location', $project->location) }}" required
                           class="w-full rounded-lg border-gray-300 text-sm focus:border-big-gold focus:ring-big-gold">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Agriculture Type *</label>
                    <input type="text" name="agriculture_type" value="{{ old('agriculture_type', $project->agriculture_type) }}" required
                           placeholder="e.g. Crop Production, Livestock, Agro-processing"
                           class="w-full rounded-lg border-gray-300 text-sm focus:border-big-gold focus:ring-big-gold">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Status *</label>
                    <select name="status" required class="w-full rounded-lg border-gray-300 text-sm focus:border-big-gold focus:ring-big-gold">
                        @foreach (['Active', 'Completed', 'Planned', 'On Hold'] as $status)
                            <option value="{{ $status }}" @selected(old('status', $project->status) === $status)>{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Description</label>
                <textarea name="description" rows="4" class="w-full rounded-lg border-gray-300 text-sm focus:border-big-gold focus:ring-big-gold">{{ old('description', $project->description) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Investment Information</label>
                <textarea name="investment_information" rows="3" class="w-full rounded-lg border-gray-300 text-sm focus:border-big-gold focus:ring-big-gold">{{ old('investment_information', $project->investment_information) }}</textarea>
            </div>

            <label class="flex items-center gap-2">
                <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $project->is_featured))
                       class="rounded border-gray-300 text-big-gold focus:ring-big-gold">
                <span class="text-sm text-slate-700">Feature this project on the homepage</span>
            </label>
        </div>

        @if ($project->exists && $project->media->isNotEmpty())
        <div class="bg-white rounded-xl border border-slate-200 p-5 sm:p-6">
            <h3 class="font-semibold text-slate-800 mb-3">Current Media</h3>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                @foreach ($project->media as $media)
                <div class="relative group">
                    @if ($media->type === 'image')
                        <img src="{{ asset('storage/' . $media->path) }}" class="w-full h-24 object-cover rounded-lg">
                    @else
                        <div class="w-full h-24 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400">
                            <i data-lucide="{{ $media->type === 'video' ? 'video' : 'file-text' }}" class="w-6 h-6"></i>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('admin.agriculture.media.destroy', $media) }}" onsubmit="return confirm('Remove this media?');" class="absolute top-1 right-1">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-white/90 hover:bg-white text-red-600 rounded-full p-1 shadow"><i data-lucide="x" class="w-3 h-3"></i></button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        @if (! empty($defaultImages) && $project->media->isEmpty())
        <div class="bg-white rounded-xl border border-slate-200 p-5 sm:p-6"
             x-data="{ selected: '{{ old('default_image', '') }}' }">
            <h3 class="font-semibold text-slate-800 mb-1">Or Choose a Default Image</h3>
            <p class="text-xs text-slate-400 mb-3">Pick a placeholder to use until you upload real photos.</p>
            <div class="grid grid-cols-3 sm:grid-cols-5 gap-3">
                @foreach ($defaultImages as $default)
                <label class="relative cursor-pointer">
                    <input type="radio" name="default_image" value="{{ $default }}" x-model="selected" class="sr-only">
                    <img src="{{ asset($default) }}" class="w-full h-20 object-cover rounded-lg transition-all"
                         :class="selected === '{{ $default }}' ? 'ring-2 ring-big-gold ring-offset-2' : 'opacity-80 hover:opacity-100'">
                    <div x-show="selected === '{{ $default }}'" x-cloak class="absolute top-1 right-1 bg-big-gold rounded-full p-0.5">
                        <i data-lucide="check" class="w-3 h-3 text-big-navy-dark"></i>
                    </div>
                </label>
                @endforeach
            </div>
        </div>
        @endif

        <div class="bg-white rounded-xl border border-slate-200 p-5 sm:p-6">
            <h3 class="font-semibold text-slate-800 mb-3">Upload Media</h3>
            <input type="file" name="media[]" multiple accept="image/jpeg,image/png,image/webp,video/mp4,video/webm,application/pdf"
                   class="w-full text-sm text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-big-navy-dark file:text-white file:text-sm hover:file:bg-big-navy">
            <p class="text-xs text-slate-400 mt-2">Images (JPG/PNG/WEBP), videos (MP4/WEBM), or documents (PDF). Max 10MB each.</p>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-big-navy-dark hover:bg-big-navy text-white px-5 py-2.5 rounded-lg text-sm font-medium transition">
                {{ $project->exists ? 'Update Project' : 'Publish Project' }}
            </button>
            <a href="{{ route('admin.agriculture.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 px-5 py-2.5 rounded-lg text-sm font-medium transition">Cancel</a>
        </div>
    </form>

</x-layouts.admin>
