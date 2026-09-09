<section class="py-16 bg-big-navy-dark relative overflow-hidden">
    <div class="absolute inset-0 pointer-events-none">
        <div class="divider-gold absolute top-0 left-0 right-0"></div>
        <div class="divider-gold absolute bottom-0 left-0 right-0"></div>
    </div>
    <div class="relative max-w-screen-2xl mx-auto px-6 lg:px-10 2xl:px-16">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
            @foreach ($stats as $stat)
            <div class="text-center group">
                <div class="w-12 h-12 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center mx-auto mb-4 group-hover:border-big-gold-dark/40 transition-all">
                    <i data-lucide="{{ $stat['icon'] }}" class="w-5 h-5 {{ $stat['color'] }}"></i>
                </div>
                <p class="text-4xl font-bold text-white">{{ $stat['value'] }}</p>
                <p class="text-white font-semibold text-base mt-1">{{ $stat['label'] }}</p>
                <p class="text-slate-500 text-sm mt-1">{{ $stat['sublabel'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
