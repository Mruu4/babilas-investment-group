<section class="py-20 lg:py-28 bg-white">
    <div class="max-w-screen-2xl mx-auto px-6 lg:px-10 2xl:px-16">
        <div class="text-center mb-14">
            <p class="section-label mb-3">What We Do</p>
            <h2 class="text-3xl lg:text-4xl font-bold text-big-navy-dark mb-4">Our Investment <span class="text-big-gold-dark">Portfolio</span></h2>
            <p class="text-slate-500 text-lg max-w-2xl mx-auto leading-relaxed">
                Five strategically selected investment sectors, each managed with expertise, discipline, and a commitment to long-term value creation.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">
            @foreach ($investmentAreas as $area)
            <a href="{{ url($area['href']) }}" class="investment-card group p-6 flex flex-col">
                <div class="flex items-start justify-between mb-5">
                    <div class="w-12 h-12 rounded-xl {{ $area['bg'] }} border {{ $area['border'] }} flex items-center justify-center transition-transform group-hover:scale-110">
                        <i data-lucide="{{ $area['icon'] }}" class="w-5 h-5 {{ $area['color'] }}"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold {{ $area['color'] }}">{{ $area['count'] }}</p>
                        <p class="text-slate-400 text-xs">{{ $area['countLabel'] }}</p>
                    </div>
                </div>
                <div class="flex-1">
                    <p class="text-xs font-semibold {{ $area['color'] }} mb-1 tracking-wide uppercase">{{ $area['tagline'] }}</p>
                    <h3 class="text-big-navy-dark font-bold text-lg mb-3 group-hover:text-big-gold-dark transition-colors">{{ $area['label'] }}</h3>
                    <p class="text-slate-500 text-sm leading-relaxed line-clamp-3">{{ $area['description'] }}</p>
                </div>
                <div class="flex items-center gap-2 mt-5 pt-4 border-t border-slate-100 {{ $area['color'] }} text-sm font-semibold">
                    <span>Explore</span>
                    <i data-lucide="arrow-right" class="w-3.5 h-3.5 transition-transform group-hover:translate-x-1"></i>
                </div>
            </a>
            @endforeach
        </div>

        <div class="text-center mt-10">
            <a href="{{ url('/investment-areas') }}" class="btn-navy-outline text-big-navy-dark border-big-navy-dark/20 hover:border-big-gold-dark/50">
                View All Investment Areas <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>
    </div>
</section>
