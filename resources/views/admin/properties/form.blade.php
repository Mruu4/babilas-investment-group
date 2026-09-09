<x-layouts.admin :title="$property->exists ? 'Edit Property' : 'Add Property'">

    <div class="mb-6">
        <a href="{{ route('admin.properties.index') }}" class="text-sm text-gray-500 hover:text-big-navy-dark inline-flex items-center gap-1 mb-2">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to Real Estate
        </a>
        <h2 class="text-2xl font-bold text-big-navy-dark">{{ $property->exists ? 'Edit Property' : 'Add Property' }}</h2>
    </div>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-700 text-sm rounded-lg">
            <p class="font-medium mb-1">Please fix the following:</p>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST"
          action="{{ $property->exists ? route('admin.properties.update', $property) : route('admin.properties.store') }}"
          enctype="multipart/form-data" class="space-y-6">
        @csrf
        @if ($property->exists) @method('PUT') @endif

        <div class="bg-white rounded-xl border border-slate-200 p-5 sm:p-6 space-y-5">
            <h3 class="font-semibold text-slate-800">Basic Information</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Property Name *</label>
                    <input type="text" name="name" value="{{ old('name', $property->name) }}" required
                           class="w-full rounded-lg border-gray-300 text-sm focus:border-big-gold focus:ring-big-gold">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Property Type *</label>
                    <input type="text" name="property_type" value="{{ old('property_type', $property->property_type) }}" required
                           placeholder="e.g. Apartment, House, Land, Commercial"
                           class="w-full rounded-lg border-gray-300 text-sm focus:border-big-gold focus:ring-big-gold">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Location *</label>
                    <input type="text" name="location" value="{{ old('location', $property->location) }}" required
                           class="w-full rounded-lg border-gray-300 text-sm focus:border-big-gold focus:ring-big-gold">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Price</label>
                    <div class="flex gap-2">
                        <select name="currency" class="w-28 rounded-lg border-gray-300 text-sm focus:border-big-gold focus:ring-big-gold">
                            <option value="NGN" @selected(old('currency', $property->currency ?? 'NGN') === 'NGN')>₦ NGN</option>
                            <option value="USD" @selected(old('currency', $property->currency ?? 'NGN') === 'USD')>$ USD</option>
                        </select>
                        <input type="number" step="0.01" name="price" value="{{ old('price', $property->price) }}"
                               class="flex-1 rounded-lg border-gray-300 text-sm focus:border-big-gold focus:ring-big-gold">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Bedrooms</label>
                    <input type="number" name="bedrooms" value="{{ old('bedrooms', $property->bedrooms) }}"
                           class="w-full rounded-lg border-gray-300 text-sm focus:border-big-gold focus:ring-big-gold">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Bathrooms</label>
                    <input type="number" name="bathrooms" value="{{ old('bathrooms', $property->bathrooms) }}"
                           class="w-full rounded-lg border-gray-300 text-sm focus:border-big-gold focus:ring-big-gold">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Size</label>
                    <input type="text" name="size" value="{{ old('size', $property->size) }}" placeholder="e.g. 2,400 sqft"
                           class="w-full rounded-lg border-gray-300 text-sm focus:border-big-gold focus:ring-big-gold">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Status *</label>
                    <select name="status" required class="w-full rounded-lg border-gray-300 text-sm focus:border-big-gold focus:ring-big-gold">
                        @foreach (['Available', 'Sold', 'Under Development', 'Coming Soon'] as $status)
                            <option value="{{ $status }}" @selected(old('status', $property->status) === $status)>{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Description</label>
                <textarea name="description" rows="4"
                          class="w-full rounded-lg border-gray-300 text-sm focus:border-big-gold focus:ring-big-gold">{{ old('description', $property->description) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Video URL</label>
                <input type="url" name="video_url" value="{{ old('video_url', $property->video_url) }}" placeholder="https://..."
                       class="w-full rounded-lg border-gray-300 text-sm focus:border-big-gold focus:ring-big-gold">
            </div>

            <label class="flex items-center gap-2">
                <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $property->is_featured))
                       class="rounded border-gray-300 text-big-gold focus:ring-big-gold">
                <span class="text-sm text-slate-700">Feature this property on the homepage</span>
            </label>
        </div>

        {{-- Features: simple repeatable text list via Alpine --}}
        <div class="bg-white rounded-xl border border-slate-200 p-5 sm:p-6"
             x-data="{ features: {{ json_encode(old('features', $property->features ?? [])) }} }">
            <h3 class="font-semibold text-slate-800 mb-3">Features</h3>
            <template x-for="(feature, i) in features" :key="i">
                <div class="flex items-center gap-2 mb-2">
                    <input type="text" :name="'features[' + i + ']'" x-model="features[i]"
                           class="flex-1 rounded-lg border-gray-300 text-sm focus:border-big-gold focus:ring-big-gold">
                    <button type="button" @click="features.splice(i, 1)" class="text-red-500 p-1.5">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                </div>
            </template>
            <button type="button" @click="features.push('')"
                    class="text-sm text-big-navy-dark font-medium inline-flex items-center gap-1 mt-1">
                <i data-lucide="plus" class="w-4 h-4"></i> Add Feature
            </button>
        </div>

        {{-- Existing images (edit mode only) --}}
        @if ($property->exists && $property->images->isNotEmpty())
        <div class="bg-white rounded-xl border border-slate-200 p-5 sm:p-6">
            <h3 class="font-semibold text-slate-800 mb-3">Current Images</h3>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                @foreach ($property->images as $image)
                <div class="relative group">
                    <img src="{{ asset('storage/' . $image->path) }}" class="w-full h-24 object-cover rounded-lg">
                    <form method="POST" action="{{ route('admin.properties.images.destroy', $image) }}"
                          onsubmit="return confirm('Remove this image?');"
                          class="absolute top-1 right-1">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-white/90 hover:bg-white text-red-600 rounded-full p-1 shadow">
                            <i data-lucide="x" class="w-3 h-3"></i>
                        </button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Default image picker --}}
        @if (! empty($defaultImages) && $property->images->isEmpty())
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

        {{-- New image upload --}}
        <div class="bg-white rounded-xl border border-slate-200 p-5 sm:p-6">
            <h3 class="font-semibold text-slate-800 mb-3">Upload Images</h3>
            <input type="file" name="images[]" multiple accept="image/jpeg,image/png,image/webp"
                   class="w-full text-sm text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-big-navy-dark file:text-white file:text-sm hover:file:bg-big-navy">
            <p class="text-xs text-slate-400 mt-2">JPG, PNG, or WEBP. Max 5MB each.</p>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-big-navy-dark hover:bg-big-navy text-white px-5 py-2.5 rounded-lg text-sm font-medium transition">
                {{ $property->exists ? 'Update Property' : 'Publish Property' }}
            </button>
            <a href="{{ route('admin.properties.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 px-5 py-2.5 rounded-lg text-sm font-medium transition">
                Cancel
            </a>
        </div>
    </form>

</x-layouts.admin>
