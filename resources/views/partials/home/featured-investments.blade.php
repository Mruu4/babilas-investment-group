<section class="py-20 lg:py-28 bg-slate-50">
    <div class="max-w-screen-2xl mx-auto px-6 lg:px-10 2xl:px-16">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div>
                <p class="section-label mb-3">Spotlight</p>
                <h2 class="text-3xl lg:text-4xl font-bold text-big-navy-dark">Featured <span class="text-big-gold-dark">Investments</span></h2>
            </div>
            <a href="{{ url('/portfolio') }}" class="btn-navy-outline text-big-navy-dark border-big-navy-dark/20 hover:border-big-gold-dark/50 self-start md:self-auto text-sm py-2.5 px-5">
                View Full Portfolio <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
            @foreach ($featuredProperties as $property)
            <a href="{{ route('admin.properties.index') }}" class="investment-card group flex flex-col">
                <div class="relative h-52 overflow-hidden">
                    @if ($property->images->first())
                        <img src="{{ asset('storage/' . $property->images->first()->path) }}" alt="{{ $property->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    @else
                        <div class="w-full h-full bg-slate-200"></div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                    <div class="absolute top-4 left-4">
                        <span class="status-badge status-featured">{{ $property->status }}</span>
                    </div>
                    <div class="absolute top-4 right-4">
                        <i data-lucide="star" class="w-4 h-4 text-big-gold-light fill-current"></i>
                    </div>
                    <div class="absolute bottom-4 left-4 bg-big-navy-dark/80 backdrop-blur-sm border border-big-gold-dark/20 rounded-lg px-3 py-1.5">
                        <p class="text-big-gold-light text-xs font-semibold">{{ $property->bedrooms ? $property->bedrooms . ' Bed' : $property->property_type }}</p>
                    </div>
                </div>
                <div class="flex-1 p-5">
                    <div class="flex items-center gap-2 mb-3">
                        <i data-lucide="building-2" class="w-3.5 h-3.5 text-sky-500"></i>
                        <span class="text-xs font-semibold text-sky-500">Real Estate</span>
                    </div>
                    <h3 class="text-big-navy-dark font-bold text-lg mb-2 group-hover:text-big-gold-dark transition-colors leading-tight">{{ $property->name }}</h3>
                    <div class="flex items-center gap-1.5 mb-3">
                        <i data-lucide="map-pin" class="w-3 h-3 text-slate-400"></i>
                        <span class="text-slate-500 text-sm">{{ $property->location }}</span>
                    </div>
                    <p class="text-slate-500 text-sm leading-relaxed line-clamp-3">{{ $property->description }}</p>
                </div>
                <div class="px-5 pb-5">
                    <div class="flex items-center gap-2 text-big-gold-dark text-sm font-semibold pt-4 border-t border-slate-100">
                        <span>View Details</span>
                        <i data-lucide="arrow-right" class="w-3.5 h-3.5 transition-transform group-hover:translate-x-1"></i>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
