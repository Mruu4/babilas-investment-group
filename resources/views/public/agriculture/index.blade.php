<x-layouts.public title="Agriculture - Babilas Investment Group">

    <section class="bg-hero-gradient py-20">
        <div class="max-w-screen-2xl mx-auto px-6 lg:px-10 2xl:px-16 text-center">
            <p class="section-label mb-3">Investment Area</p>
            <h1 class="text-4xl lg:text-5xl font-bold text-white mb-4">Agriculture</h1>
            <p class="text-slate-300 text-lg max-w-2xl mx-auto">Crop production, livestock, agro-processing, and agricultural development across Nigeria.</p>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="max-w-screen-2xl mx-auto px-6 lg:px-10 2xl:px-16">
            @if ($projects->isEmpty())
                <p class="text-center text-slate-500 py-20">No agriculture projects available at the moment.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
                    @foreach ($projects as $project)
                    @php $img = $project->media->firstWhere('type', 'image'); @endphp
                    <a href="{{ url('/agriculture/' . $project->slug) }}" class="investment-card group flex flex-col">
                        <div class="relative h-52 overflow-hidden">
                            @if ($img)
                                <img src="{{ asset('storage/' . $img->path) }}" alt="{{ $project->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            @else
                                <div class="w-full h-full bg-slate-200"></div>
                            @endif
                            <div class="absolute top-4 left-4">
                                <span class="status-badge {{ $project->status === 'Active' ? 'status-active' : 'bg-slate-500 text-white' }}">{{ $project->status }}</span>
                            </div>
                        </div>
                        <div class="flex-1 p-5">
                            <p class="text-xs font-semibold text-emerald-600 mb-2">{{ $project->agriculture_type }}</p>
                            <h3 class="text-big-navy-dark font-bold text-lg mb-2 group-hover:text-big-gold-dark transition-colors">{{ $project->name }}</h3>
                            <div class="flex items-center gap-1.5 mb-3">
                                <i data-lucide="map-pin" class="w-3 h-3 text-slate-400"></i>
                                <span class="text-slate-500 text-sm">{{ $project->location }}</span>
                            </div>
                            <p class="text-slate-600 text-sm line-clamp-2">{{ $project->description }}</p>
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
                <div class="mt-8">{{ $projects->links() }}</div>
            @endif
        </div>
    </section>

</x-layouts.public>
