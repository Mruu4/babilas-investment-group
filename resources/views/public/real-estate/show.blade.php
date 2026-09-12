<x-layouts.public :title="$property->name . ' - Babilas Investment Group'">

    <section class="py-10 bg-white">
        <div class="max-w-screen-2xl mx-auto px-6 lg:px-10 2xl:px-16">
            <a href="{{ url('/real-estate') }}" class="text-sm text-slate-500 hover:text-big-navy-dark inline-flex items-center gap-1 mb-6">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to Real Estate
            </a>

            {{-- Image gallery --}}
            @if ($property->images->isNotEmpty())
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-3 mb-10 rounded-2xl overflow-hidden">
                <div class="lg:col-span-2 h-80 lg:h-[420px]">
                    <img src="{{ asset('storage/' . $property->images->first()->path) }}" class="w-full h-full object-cover">
                </div>
                @if ($property->images->count() > 1)
                <div class="grid grid-cols-2 lg:grid-cols-1 gap-3 h-80 lg:h-[420px]">
                    @foreach ($property->images->skip(1)->take(2) as $img)
                    <img src="{{ asset('storage/' . $img->path) }}" class="w-full h-full object-cover">
                    @endforeach
                </div>
                @endif
            </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <div class="lg:col-span-2">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="status-badge {{ $property->status === 'Available' ? 'status-active' : 'bg-slate-500 text-white' }}">{{ $property->status }}</span>
                        <span class="text-slate-400 text-sm">{{ $property->property_type }}</span>
                    </div>
                    <h1 class="text-3xl lg:text-4xl font-bold text-big-navy-dark mb-3">{{ $property->name }}</h1>
                    <div class="flex items-center gap-1.5 mb-6">
                        <i data-lucide="map-pin" class="w-4 h-4 text-slate-400"></i>
                        <span class="text-slate-500">{{ $property->location }}</span>
                    </div>

                    @if ($property->bedrooms || $property->bathrooms || $property->size)
                    <div class="flex flex-wrap gap-6 mb-8 pb-8 border-b border-slate-100">
                        @if ($property->bedrooms)
                        <div class="flex items-center gap-2"><i data-lucide="bed" class="w-4 h-4 text-big-gold-dark"></i><span class="text-slate-700 text-sm">{{ $property->bedrooms }} Bedrooms</span></div>
                        @endif
                        @if ($property->bathrooms)
                        <div class="flex items-center gap-2"><i data-lucide="bath" class="w-4 h-4 text-big-gold-dark"></i><span class="text-slate-700 text-sm">{{ $property->bathrooms }} Bathrooms</span></div>
                        @endif
                        @if ($property->size)
                        <div class="flex items-center gap-2"><i data-lucide="ruler" class="w-4 h-4 text-big-gold-dark"></i><span class="text-slate-700 text-sm">{{ $property->size }}</span></div>
                        @endif
                    </div>
                    @endif

                    <h3 class="font-semibold text-big-navy-dark mb-3">Description</h3>
                    <p class="text-slate-600 leading-relaxed mb-8">{{ $property->description }}</p>

                    @if ($property->features)
                    <h3 class="font-semibold text-big-navy-dark mb-3">Features</h3>
                    <div class="grid grid-cols-2 gap-3 mb-8">
                        @foreach ($property->features as $feature)
                        <div class="flex items-center gap-2"><i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-500"></i><span class="text-slate-600 text-sm">{{ $feature }}</span></div>
                        @endforeach
                    </div>
                    @endif
                </div>

                {{-- Sidebar: price + enquiry --}}
                <div>
                    <div class="bg-slate-50 rounded-2xl p-6 sticky top-24">
                        <p class="text-slate-400 text-xs uppercase tracking-wide mb-1">Price</p>
                        <p class="text-2xl font-bold text-big-navy-dark mb-6">
                            {{ $property->price ? ($property->currency === 'USD' ? '$' : '₦') . number_format($property->price) : 'Price on request' }}
                        </p>
                        <a href="{{ url('/contact') }}" class="btn-gold w-full justify-center">
                            <i data-lucide="message-square" class="w-4 h-4"></i> Enquire Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-layouts.public>
