@if ($activeAd)
<section class="py-8 bg-white">
    <div class="max-w-screen-2xl mx-auto px-6 lg:px-10 2xl:px-16">
        <div class="relative overflow-hidden rounded-2xl bg-gold-gradient p-8 lg:p-10">
            <div class="relative flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-big-navy-dark/20 flex items-center justify-center shrink-0">
                        <i data-lucide="zap" class="w-5 h-5 text-big-navy-dark"></i>
                    </div>
                    <div>
                        @if ($activeAd->subtitle)
                        <p class="text-big-navy-dark/60 text-xs font-semibold uppercase tracking-widest mb-1">{{ $activeAd->subtitle }}</p>
                        @endif
                        <h3 class="text-big-navy-dark font-bold text-xl lg:text-2xl leading-tight mb-2">{{ $activeAd->title }}</h3>
                        <p class="text-big-navy-dark/70 text-sm lg:text-base max-w-xl leading-relaxed">{{ $activeAd->description }}</p>
                    </div>
                </div>
                @if ($activeAd->cta_text && $activeAd->cta_url)
                <a href="{{ $activeAd->cta_url }}" class="inline-flex items-center gap-2 bg-big-navy-dark text-big-gold-light font-semibold px-6 py-3 rounded-lg hover:bg-big-navy transition-all text-sm shrink-0">
                    {{ $activeAd->cta_text }} <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                </a>
                @endif
            </div>
        </div>
    </div>
</section>
@endif
