<footer class="bg-big-navy-dark border-t border-big-gold-dark/20">
    <div class="max-w-screen-2xl mx-auto px-6 lg:px-10 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-12">

            <div class="lg:col-span-1">
                <div class="flex items-center gap-3 mb-5">
                    <div class="bg-white/95 rounded-lg p-1.5">
                        <img src="{{ asset('images/logo.png') }}" alt="BIG" class="h-10 w-10 object-contain">
                    </div>
                    <div>
                        <p class="text-white font-bold text-base leading-tight">Babilas Investment</p>
                        <p class="text-big-gold-light font-semibold text-base leading-tight">Group Ltd</p>
                    </div>
                </div>
                <p class="text-slate-400 text-sm leading-relaxed mb-5">
                    A diversified investment group committed to building businesses, creating value, and shaping the future across Nigeria and beyond.
                </p>
                <div class="inline-flex items-center gap-2 px-4 py-2 border border-big-gold-dark/30 rounded-full">
                    <div class="w-1.5 h-1.5 rounded-full bg-big-gold-light"></div>
                    <span class="text-big-gold-light text-xs font-semibold tracking-widest uppercase">Invest • Grow • Prosper</span>
                </div>
                <div class="flex items-center gap-3 mt-6">
                    <a href="#" aria-label="LinkedIn" class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-slate-400 hover:text-big-gold-light hover:border-big-gold-dark/40 hover:bg-big-gold-dark/10 transition-all">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
                    </a>
                    <a href="#" aria-label="Twitter / X" class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-slate-400 hover:text-big-gold-light hover:border-big-gold-dark/40 hover:bg-big-gold-dark/10 transition-all">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                    <a href="#" aria-label="Facebook" class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-slate-400 hover:text-big-gold-light hover:border-big-gold-dark/40 hover:bg-big-gold-dark/10 transition-all">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                    </a>
                    <a href="#" aria-label="Instagram" class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-slate-400 hover:text-big-gold-light hover:border-big-gold-dark/40 hover:bg-big-gold-dark/10 transition-all">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                    </a>
                </div>
            </div>

            <div>
                <h4 class="text-white font-semibold text-sm mb-5 flex items-center gap-2"><span class="w-4 h-0.5 bg-big-gold-light"></span> Investment Areas</h4>
                <ul class="space-y-2.5">
                    @foreach ([['Real Estate', '/real-estate'], ['Agriculture', '/agriculture'], ['Technology', '/technology'], ['Automobiles', '/automobiles'], ['Stocks & Investments', '/investments'], ['Portfolio Overview', '/portfolio']] as [$label, $href])
                    <li><a href="{{ url($href) }}" class="text-slate-400 hover:text-big-gold-light text-sm transition-colors">{{ $label }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h4 class="text-white font-semibold text-sm mb-5 flex items-center gap-2"><span class="w-4 h-0.5 bg-big-gold-light"></span> Company</h4>
                <ul class="space-y-2.5">
                    @foreach ([['About BIG', '/about'], ['Investment Areas', '/investment-areas'], ['News & Insights', '/news'], ['Partner With Us', '/partner-with-us'], ['Contact Us', '/contact']] as [$label, $href])
                    <li><a href="{{ url($href) }}" class="text-slate-400 hover:text-big-gold-light text-sm transition-colors">{{ $label }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h4 class="text-white font-semibold text-sm mb-5 flex items-center gap-2"><span class="w-4 h-0.5 bg-big-gold-light"></span> Contact Us</h4>
                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-big-gold-dark/10 flex items-center justify-center shrink-0 mt-0.5"><i data-lucide="map-pin" class="w-3.5 h-3.5 text-big-gold-light"></i></div>
                        <p class="text-slate-400 text-sm leading-relaxed">[COMPANY ADDRESS]</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-big-gold-dark/10 flex items-center justify-center shrink-0"><i data-lucide="phone" class="w-3.5 h-3.5 text-big-gold-light"></i></div>
                        <p class="text-slate-400 text-sm">[OFFICIAL PHONE]</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-big-gold-dark/10 flex items-center justify-center shrink-0"><i data-lucide="mail" class="w-3.5 h-3.5 text-big-gold-light"></i></div>
                        <p class="text-slate-400 text-sm">[OFFICIAL EMAIL]</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="border-t border-white/5">
        <div class="max-w-screen-2xl mx-auto px-6 lg:px-10 py-5 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p class="text-slate-500 text-xs">© {{ date('Y') }} Babilas Investment Group Ltd. All rights reserved.</p>
            <div class="flex items-center gap-5">
                <a href="{{ url('/privacy') }}" class="text-slate-500 hover:text-slate-300 text-xs">Privacy Policy</a>
                <a href="{{ url('/terms') }}" class="text-slate-500 hover:text-slate-300 text-xs">Terms of Use</a>
                <a href="{{ route('login') }}" class="text-slate-600 hover:text-slate-400 text-xs">Admin</a>
            </div>
        </div>
    </div>
</footer>
