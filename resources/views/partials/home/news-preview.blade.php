@if ($newsArticles->isNotEmpty())
<section class="py-20 lg:py-28 bg-white">
    <div class="max-w-screen-2xl mx-auto px-6 lg:px-10 2xl:px-16">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div>
                <p class="section-label mb-3">Latest Updates</p>
                <h2 class="text-3xl lg:text-4xl font-bold text-big-navy-dark">News & <span class="text-big-gold-dark">Insights</span></h2>
            </div>
            <a href="{{ url('/news') }}" class="btn-navy-outline text-big-navy-dark border-big-navy-dark/20 hover:border-big-gold-dark/50 self-start md:self-auto text-sm py-2.5 px-5">
                All Articles <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
            @foreach ($newsArticles as $article)
            <a href="{{ url('/news/' . $article->slug) }}" class="investment-card group flex flex-col">
                @if ($article->featured_image)
                <div class="relative h-48 overflow-hidden">
                    <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                </div>
                @endif
                <div class="flex-1 p-5">
                    <h3 class="text-big-navy-dark font-bold text-base mb-3 group-hover:text-big-gold-dark transition-colors leading-snug line-clamp-2">{{ $article->title }}</h3>
                    <p class="text-slate-500 text-sm leading-relaxed line-clamp-2">{{ Str::limit(strip_tags($article->content), 120) }}</p>
                </div>
                <div class="px-5 pb-5 border-t border-slate-100 pt-4 flex items-center justify-between gap-3">
                    <span class="text-xs text-slate-400">{{ $article->published_at?->format('M j, Y') }}</span>
                    <span class="text-big-gold-dark text-xs font-semibold flex items-center gap-1">Read <i data-lucide="arrow-right" class="w-3 h-3"></i></span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif
