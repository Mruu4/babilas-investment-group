<section class="relative min-h-screen flex items-center bg-hero-gradient overflow-hidden">
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 right-0 w-[600px] h-[600px] opacity-10 rounded-full" style="background: radial-gradient(circle at 70% 30%, rgba(201,162,39,0.15), transparent 60%);"></div>
        <div class="absolute top-0 right-40 w-px h-full bg-gradient-to-b from-transparent via-big-gold-dark/20 to-transparent"></div>
    </div>

    <div class="relative max-w-screen-2xl mx-auto px-6 lg:px-10 2xl:px-16 py-24 w-full">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            <div class="animate-fade-in">
                <div class="inline-flex items-center gap-2.5 px-4 py-2 bg-big-gold-dark/10 border border-big-gold-dark/25 rounded-full mb-8">
                    <span class="w-2 h-2 rounded-full bg-big-gold-light animate-pulse-gold"></span>
                    <span class="section-label text-xs">Invest • Grow • Prosper</span>
                </div>

                <h1 class="text-hero-xl font-bold text-white leading-tight mb-6">
                    Building <span class="text-big-gold-light">Businesses.</span><br>
                    Creating <span class="text-big-gold-light">Value.</span><br>
                    Shaping the
                    <span class="relative">
                        Future.
                        <span class="absolute -bottom-2 left-0 right-0 h-1 bg-gold-gradient opacity-60 rounded"></span>
                    </span>
                </h1>

                <p class="text-hero-sub text-slate-300 mb-10 max-w-xl leading-relaxed">
                    Babilas Investment Group Ltd is a diversified investment group driving economic growth across Real Estate, Agriculture, Technology, Automobiles, and Stocks throughout Nigeria and beyond.
                </p>

                <div class="flex flex-wrap gap-4 mb-12">
                    <a href="{{ url('/investment-areas') }}" class="btn-gold text-base py-3.5 px-7">
                        Explore Our Investments <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                    <a href="{{ url('/partner-with-us') }}" class="btn-navy-outline text-base py-3.5 px-7">
                        <i data-lucide="play" class="w-4 h-4"></i> Partner With Us
                    </a>
                </div>

                <div class="flex flex-wrap gap-4">
                    @foreach ([['shield', 'Trusted Investment Group'], ['trending-up', 'Proven Track Record'], ['globe', 'Nigeria-Wide Reach']] as [$icon, $label])
                    <div class="flex items-center gap-2 px-4 py-2 bg-white/5 border border-white/10 rounded-full">
                        <i data-lucide="{{ $icon }}" class="w-3.5 h-3.5 text-big-gold-light"></i>
                        <span class="text-slate-300 text-xs font-medium">{{ $label }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="hidden lg:block relative">
                <div class="relative">
                    <div class="rounded-2xl overflow-hidden shadow-navy-lg border border-big-gold-dark/20">
                        <img src="{{ asset('storage/properties/property-2-imperial-waterfront.png') }}"
                             alt="Luxury real estate development representing BIG property investments"
                             class="w-full h-80 object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-big-navy-dark/60 to-transparent rounded-2xl"></div>
                    </div>

                    <div class="absolute -bottom-6 -left-6 bg-big-navy border border-big-gold-dark/30 rounded-xl p-4 shadow-gold">
                        <p class="text-slate-400 text-xs font-medium mb-1">Active Investments</p>
                        <p class="text-white font-bold text-2xl">{{ $totalActive ?? 5 }}+</p>
                        <p class="text-emerald-400 text-xs mt-1 flex items-center gap-1">
                            <i data-lucide="trending-up" class="w-3 h-3"></i> Across 5 sectors
                        </p>
                    </div>

                    <div class="absolute -top-5 -right-5 bg-big-navy border border-big-gold-dark/30 rounded-xl p-4 shadow-gold">
                        <p class="text-slate-400 text-xs font-medium mb-1">Investment Categories</p>
                        <p class="text-white font-bold text-2xl">5</p>
                        <p class="text-big-gold-light text-xs mt-1">Diversified sectors</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 opacity-40">
            <p class="text-slate-400 text-xs tracking-widest uppercase">Scroll</p>
            <div class="w-px h-12 bg-gradient-to-b from-big-gold-light to-transparent"></div>
        </div>
    </div>
</section>
