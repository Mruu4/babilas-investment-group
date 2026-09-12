<x-layouts.public :title="$project->name . ' - Babilas Investment Group'">

    <section class="py-10 bg-white">
        <div class="max-w-screen-2xl mx-auto px-6 lg:px-10 2xl:px-16">
            <a href="{{ url('/technology') }}" class="text-sm text-slate-500 hover:text-big-navy-dark inline-flex items-center gap-1 mb-6">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to Technology
            </a>

            @php $images = $project->media->where('type', 'image'); @endphp
            @if ($images->isNotEmpty())
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-3 mb-10 rounded-2xl overflow-hidden">
                <div class="lg:col-span-2 h-80 lg:h-[420px]">
                    <img src="{{ asset('storage/' . $images->first()->path) }}" class="w-full h-full object-cover">
                </div>
                @if ($images->count() > 1)
                <div class="grid grid-cols-2 lg:grid-cols-1 gap-3 h-80 lg:h-[420px]">
                    @foreach ($images->skip(1)->take(2) as $img)
                    <img src="{{ asset('storage/' . $img->path) }}" class="w-full h-full object-cover">
                    @endforeach
                </div>
                @endif
            </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <div class="lg:col-span-2">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="status-badge {{ $project->status === 'Active' ? 'status-active' : 'bg-slate-500 text-white' }}">{{ $project->status }}</span>
                        <span class="text-slate-400 text-sm">{{ $project->sector }}</span>
                        @if ($project->investment_stage)
                        <span class="text-slate-400 text-sm">· {{ $project->investment_stage }}</span>
                        @endif
                    </div>
                    <h1 class="text-3xl lg:text-4xl font-bold text-big-navy-dark mb-6">{{ $project->name }}</h1>

                    <h3 class="font-semibold text-big-navy-dark mb-3">Description</h3>
                    <p class="text-slate-600 leading-relaxed mb-8">{{ $project->description }}</p>

                    @if ($project->investment_information)
                    <h3 class="font-semibold text-big-navy-dark mb-3">Investment Information</h3>
                    <p class="text-slate-600 leading-relaxed mb-8">{{ $project->investment_information }}</p>
                    @endif

                    @if ($project->website)
                    <a href="{{ $project->website }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 text-big-gold-dark font-semibold text-sm hover:text-big-gold">
                        <i data-lucide="external-link" class="w-4 h-4"></i> Visit Website
                    </a>
                    @endif
                </div>

                <div>
                    <div class="bg-slate-50 rounded-2xl p-6 sticky top-24">
                        <p class="text-slate-400 text-xs uppercase tracking-wide mb-1">Interested in this venture?</p>
                        <p class="text-slate-600 text-sm mb-6">Reach out to our investment team to learn more.</p>
                        <a href="{{ url('/contact') }}" class="btn-gold w-full justify-center">
                            <i data-lucide="message-square" class="w-4 h-4"></i> Enquire Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-layouts.public>
