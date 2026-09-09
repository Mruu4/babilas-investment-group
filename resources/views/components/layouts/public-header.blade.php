<header x-data="{ mobileOpen: false, dropdownOpen: false, scrolled: false }"
        x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 20)"
        :class="scrolled ? 'bg-big-navy-dark shadow-navy-lg border-b border-big-gold-dark/20' : 'bg-big-navy-dark/95 backdrop-blur-sm'"
        class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
    <div class="max-w-screen-2xl mx-auto px-6 lg:px-10">
        <div class="flex items-center justify-between h-20">

            <a href="{{ url('/') }}" class="flex items-center gap-3 shrink-0">
                <div class="bg-white/95 rounded-lg p-1.5">
                    <img src="{{ asset('images/logo.png') }}" alt="BIG" class="h-9 w-9 object-contain">
                </div>
                <div class="hidden sm:block">
                    <div class="flex items-center gap-1.5">
                        <span class="text-white font-bold text-lg tracking-tight leading-none">Babilas</span>
                        <span class="text-big-gold-light font-bold text-lg tracking-tight leading-none">Investment</span>
                    </div>
                    <p class="text-xs text-slate-400 font-medium tracking-wider mt-0.5">GROUP LTD</p>
                </div>
            </a>

            <nav class="hidden lg:flex items-center gap-1">
                <a href="{{ url('/') }}" class="public-nav-link px-3 py-2 rounded-lg hover:bg-white/5">Home</a>

                <div class="relative" @click.outside="dropdownOpen = false">
                    <button @click="dropdownOpen = !dropdownOpen" class="public-nav-link flex items-center gap-1 px-3 py-2 rounded-lg hover:bg-white/5">
                        Investment Areas
                        <i data-lucide="chevron-down" class="w-3.5 h-3.5 transition-transform" :class="dropdownOpen ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="dropdownOpen" x-cloak x-transition
                         class="absolute top-full left-1/2 -translate-x-1/2 mt-2 w-72 bg-big-navy border border-big-gold-dark/20 rounded-xl shadow-navy-lg overflow-hidden">
                        <div class="p-2">
                            @foreach ([
                                ['label' => 'Real Estate', 'icon' => 'building-2', 'desc' => 'Premium properties & developments', 'href' => '/real-estate'],
                                ['label' => 'Agriculture', 'icon' => 'sprout', 'desc' => 'Agri-business & food systems', 'href' => '/agriculture'],
                                ['label' => 'Technology', 'icon' => 'cpu', 'desc' => 'Software, FinTech & AI ventures', 'href' => '/technology'],
                                ['label' => 'Automobiles', 'icon' => 'car', 'desc' => 'Vehicle sales & fleet management', 'href' => '/automobiles'],
                                ['label' => 'Stocks & Investments', 'icon' => 'trending-up', 'desc' => 'Equity holdings & portfolio', 'href' => '/investments'],
                            ] as $item)
                            <a href="{{ url($item['href']) }}" class="flex items-start gap-3 p-3 rounded-lg hover:bg-white/5 transition-all group">
                                <div class="w-9 h-9 rounded-lg bg-big-gold-dark/10 flex items-center justify-center shrink-0 group-hover:bg-big-gold-dark/20">
                                    <i data-lucide="{{ $item['icon'] }}" class="w-4 h-4 text-big-gold-light"></i>
                                </div>
                                <div>
                                    <p class="text-white text-sm font-semibold">{{ $item['label'] }}</p>
                                    <p class="text-slate-400 text-xs mt-0.5">{{ $item['desc'] }}</p>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <a href="{{ url('/portfolio') }}" class="public-nav-link px-3 py-2 rounded-lg hover:bg-white/5">Portfolio</a>
                <a href="{{ url('/about') }}" class="public-nav-link px-3 py-2 rounded-lg hover:bg-white/5">About</a>
                <a href="{{ url('/news') }}" class="public-nav-link px-3 py-2 rounded-lg hover:bg-white/5">News</a>
                <a href="{{ url('/contact') }}" class="public-nav-link px-3 py-2 rounded-lg hover:bg-white/5">Contact</a>
            </nav>

            <div class="flex items-center gap-3">
                <a href="{{ url('/partner-with-us') }}" class="hidden lg:inline-flex btn-gold text-sm py-2.5 px-5">Partner With Us</a>
                <a href="{{ route('login') }}" class="hidden lg:inline-flex items-center gap-1.5 text-slate-400 hover:text-big-gold-light text-xs font-medium transition-colors px-2 py-1.5 rounded border border-slate-700/50 hover:border-big-gold-dark/40">
                    <i data-lucide="bar-chart-3" class="w-3.5 h-3.5"></i> Admin
                </a>
                <button @click="mobileOpen = !mobileOpen" class="lg:hidden p-2 rounded-lg text-slate-300 hover:text-white hover:bg-white/10">
                    <i x-show="!mobileOpen" data-lucide="menu" class="w-6 h-6"></i>
                    <i x-show="mobileOpen" x-cloak data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>
        </div>
    </div>

    <div x-show="mobileOpen" x-cloak x-transition class="lg:hidden bg-big-navy border-t border-big-gold-dark/20">
        <div class="px-4 py-4 space-y-1">
            <a href="{{ url('/') }}" class="block px-4 py-3 text-slate-300 hover:text-big-gold-light hover:bg-white/5 rounded-lg text-sm font-medium">Home</a>
            <a href="{{ url('/portfolio') }}" class="block px-4 py-3 text-slate-300 hover:text-big-gold-light hover:bg-white/5 rounded-lg text-sm font-medium">Portfolio</a>
            <a href="{{ url('/about') }}" class="block px-4 py-3 text-slate-300 hover:text-big-gold-light hover:bg-white/5 rounded-lg text-sm font-medium">About</a>
            <a href="{{ url('/news') }}" class="block px-4 py-3 text-slate-300 hover:text-big-gold-light hover:bg-white/5 rounded-lg text-sm font-medium">News</a>
            <a href="{{ url('/contact') }}" class="block px-4 py-3 text-slate-300 hover:text-big-gold-light hover:bg-white/5 rounded-lg text-sm font-medium">Contact</a>
            <div class="pt-3 border-t border-white/10 mt-2">
                <a href="{{ url('/partner-with-us') }}" class="btn-gold w-full justify-center text-sm">Partner With Us</a>
            </div>
        </div>
    </div>
</header>
