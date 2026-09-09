<section class="py-20 lg:py-28 bg-hero-gradient relative overflow-hidden">
    <div class="relative max-w-screen-2xl mx-auto px-6 lg:px-10 2xl:px-16">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-14 items-center">
            <div>
                <p class="section-label mb-4">Partner With BIG</p>
                <h2 class="text-3xl lg:text-4xl xl:text-5xl font-bold text-white mb-6 leading-tight">
                    Ready to Invest in <span class="text-big-gold-light">Nigeria's Future?</span>
                </h2>
                <p class="text-slate-300 text-lg leading-relaxed mb-8">
                    Join Babilas Investment Group Ltd as a partner or investor. We identify, develop, and manage high-potential investments that deliver long-term value across Nigeria's most promising sectors.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ url('/partner-with-us') }}" class="btn-gold text-base py-3.5 px-7">Submit Investment Enquiry <i data-lucide="arrow-right" class="w-4 h-4"></i></a>
                    <a href="{{ url('/about') }}" class="btn-navy-outline text-base py-3.5 px-7">Learn About BIG</a>
                </div>
            </div>

            <div class="bg-white/5 border border-big-gold-dark/20 rounded-2xl p-8 backdrop-blur-sm">
                <h3 class="text-white font-bold text-xl mb-6">Why Partner With BIG?</h3>
                <div class="space-y-4">
                    @foreach ([
                        'Access to diversified, high-potential investment opportunities',
                        'Expert portfolio management and strategic guidance',
                        'Transparent reporting and regular performance updates',
                        'Long-term partnership focused on sustainable value creation',
                    ] as $benefit)
                    <div class="flex items-start gap-3">
                        <i data-lucide="check-circle-2" class="w-4 h-4 text-big-gold-light shrink-0 mt-0.5"></i>
                        <p class="text-slate-300 text-sm leading-relaxed">{{ $benefit }}</p>
                    </div>
                    @endforeach
                </div>
                <div class="mt-8 pt-6 border-t border-white/10">
                    <div class="flex items-center gap-4">
                        <div class="text-center"><p class="text-big-gold-light font-bold text-2xl">5</p><p class="text-slate-500 text-xs mt-0.5">Sectors</p></div>
                        <div class="w-px h-10 bg-white/10"></div>
                        <div class="text-center"><p class="text-big-gold-light font-bold text-2xl">{{ $totalActive ?? 5 }}+</p><p class="text-slate-500 text-xs mt-0.5">Projects</p></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
