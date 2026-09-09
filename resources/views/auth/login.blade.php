<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sign In - Babilas Investment Group</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">

<div class="min-h-screen bg-big-navy-dark flex relative overflow-hidden"
     x-data="{
        showPassword: false,
        copiedField: null,
        copy(text, field) {
            navigator.clipboard.writeText(text);
            this.copiedField = field;
            setTimeout(() => this.copiedField = null, 2000);
        },
        useCredential(email, password) {
            document.getElementById('email').value = email;
            document.getElementById('password').value = password;
        }
     }">

    {{-- Background decoration --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-32 -right-32 w-96 h-96 rounded-full opacity-5"
             style="background: radial-gradient(circle, #C9A227, transparent);"></div>
        <div class="absolute -bottom-40 -left-40 w-[500px] h-[500px] rounded-full opacity-5"
             style="background: radial-gradient(circle, #D4AF37, transparent);"></div>
    </div>

    {{-- Left panel: branding --}}
    <div class="hidden xl:flex xl:w-[45%] flex-col justify-between p-12 relative border-r border-big-gold-dark/10">
        <div class="flex items-center gap-4">
            <img src="{{ asset('images/logo.png') }}" alt="Babilas" class="h-12 w-auto bg-white/95 rounded-xl p-2">
            <div>
                <p class="text-white font-bold text-xl leading-tight">Babilas Investment</p>
                <p class="text-big-gold-light font-bold text-xl leading-tight">Group Ltd</p>
            </div>
        </div>

        <div class="space-y-8">
            <div>
                <p class="text-xs uppercase tracking-wider text-gray-400 font-bold mb-4">Our Motto</p>
                <h2 class="text-4xl font-bold text-white leading-tight">
                    Invest <span class="text-big-gold-light">•</span>
                    Grow <span class="text-big-gold-light">•</span>
                    Prosper
                </h2>
                <p class="text-slate-400 text-base mt-4 leading-relaxed max-w-sm">
                    Managing a diversified portfolio across Real Estate, Agriculture, Technology, Automobiles, and Stocks — driving growth across Nigeria and beyond.
                </p>
            </div>

            <div class="grid grid-cols-3 gap-4">
                @foreach ([['label' => 'Investment Areas', 'value' => '5'], ['label' => 'Active Projects', 'value' => '20+'], ['label' => 'Years of Growth', 'value' => '10+']] as $stat)
                <div class="p-4 rounded-xl border border-big-gold-dark/20 bg-white/5">
                    <p class="text-big-gold-light font-bold text-2xl">{{ $stat['value'] }}</p>
                    <p class="text-slate-500 text-xs mt-1 leading-tight">{{ $stat['label'] }}</p>
                </div>
                @endforeach
            </div>
        </div>

        <div class="flex items-center gap-2">
            <i data-lucide="shield-check" class="w-3.5 h-3.5 text-big-gold-light"></i>
            <p class="text-slate-500 text-xs">Secured admin portal — authorized personnel only</p>
        </div>
    </div>

    {{-- Right panel: login form --}}
    <div class="flex-1 flex items-center justify-center p-6 xl:p-12">
        <div class="w-full max-w-md">

            <div class="xl:hidden flex items-center gap-3 mb-8 justify-center">
                <img src="{{ asset('images/logo.png') }}" alt="Babilas" class="h-10 w-auto bg-white/95 rounded-xl p-1.5">
                <div>
                    <p class="text-white font-bold text-lg leading-tight">Babilas Investment</p>
                    <p class="text-big-gold-light font-semibold text-lg leading-tight">Group Ltd</p>
                </div>
            </div>

            <div class="bg-big-navy border border-big-gold-dark/20 rounded-2xl p-8 shadow-2xl">
                <div class="mb-8">
                    <h1 class="text-white font-bold text-2xl leading-tight">Sign in to Dashboard</h1>
                    <p class="text-slate-400 text-sm mt-2">Access the BIG management portal</p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 flex items-start gap-3 p-4 bg-red-500/10 border border-red-500/20 rounded-xl">
                        <i data-lucide="alert-circle" class="w-4 h-4 text-red-400 flex-shrink-0 mt-0.5"></i>
                        <p class="text-red-300 text-sm leading-relaxed">{{ $errors->first() }}</p>
                    </div>
                @endif

                @if (session('status'))
                    <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-xl text-emerald-300 text-sm">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-300 mb-2">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email"
                               placeholder="admin@babilas.test"
                               class="w-full px-4 py-3 bg-big-navy-light border border-white/10 rounded-xl text-white placeholder-slate-600 text-sm focus:border-big-gold-mid focus:ring-2 focus:ring-big-gold-mid/50 outline-none transition-all">
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="password" class="block text-sm font-semibold text-slate-300">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-big-gold-light hover:text-big-gold-mid text-xs font-medium">Forgot password?</a>
                            @endif
                        </div>
                        <div class="relative">
                            <input :type="showPassword ? 'text' : 'password'" id="password" name="password" required autocomplete="current-password"
                                   placeholder="Enter your password"
                                   class="w-full px-4 py-3 pr-12 bg-big-navy-light border border-white/10 rounded-xl text-white placeholder-slate-600 text-sm focus:border-big-gold-mid focus:ring-2 focus:ring-big-gold-mid/50 outline-none transition-all">
                            <button type="button" @click="showPassword = !showPassword"
                                    class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-500 hover:text-slate-300">
                                <i x-show="!showPassword" data-lucide="eye" class="w-4 h-4"></i>
                                <i x-show="showPassword" data-lucide="eye-off" class="w-4 h-4" x-cloak></i>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center gap-2.5">
                        <input id="remember_me" type="checkbox" name="remember"
                               class="w-4 h-4 rounded border-white/20 bg-big-navy-light text-big-gold-mid focus:ring-big-gold-mid">
                        <label for="remember_me" class="text-slate-400 text-sm select-none">Remember me for 30 days</label>
                    </div>

                    <button type="submit"
                            class="w-full flex items-center justify-center gap-2 py-3.5 bg-big-gold hover:bg-big-gold-dark text-big-navy-dark font-semibold text-sm rounded-xl transition-all mt-2">
                        Sign In to Dashboard
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </button>
                </form>

                {{-- Demo accounts --}}
                <div class="mt-8 pt-6 border-t border-white/10">
                    <p class="text-xs font-semibold text-slate-400 mb-3 flex items-center gap-2">
                        <i data-lucide="shield-check" class="w-3 h-3 text-big-gold-light"></i>
                        Demo Accounts — Click to autofill
                    </p>
                    <div class="space-y-2">
                        @php
                            $demoAccounts = [
                                ['role' => 'Super Admin', 'email' => 'admin@babilas.test', 'password' => 'AdminPass123!', 'color' => 'text-big-gold-light'],
                                ['role' => 'Investment Manager', 'email' => 'investment@babilas.test', 'password' => 'InvestPass123!', 'color' => 'text-emerald-400'],
                                ['role' => 'Content Manager', 'email' => 'content@babilas.test', 'password' => 'ContentPass123!', 'color' => 'text-sky-400'],
                                ['role' => 'Editor', 'email' => 'editor@babilas.test', 'password' => 'EditorPass123!', 'color' => 'text-purple-400'],
                            ];
                        @endphp
                        @foreach ($demoAccounts as $cred)
                        <div class="flex items-center justify-between p-3 bg-big-navy-light/60 border border-white/5 rounded-lg hover:border-big-gold-dark/30 transition-all">
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-semibold {{ $cred['color'] }} mb-0.5">{{ $cred['role'] }}</p>
                                <p class="text-slate-500 text-xs truncate">{{ $cred['email'] }}</p>
                            </div>
                            <div class="flex items-center gap-1.5 ml-3 flex-shrink-0">
                                <button type="button" @click="copy('{{ $cred['email'] }}', '{{ $cred['role'] }}')"
                                        class="p-1.5 rounded text-slate-600 hover:text-slate-300">
                                    <i x-show="copiedField !== '{{ $cred['role'] }}'" data-lucide="copy" class="w-3 h-3"></i>
                                    <i x-show="copiedField === '{{ $cred['role'] }}'" data-lucide="check" class="w-3 h-3 text-emerald-400" x-cloak></i>
                                </button>
                                <button type="button" @click="useCredential('{{ $cred['email'] }}', '{{ $cred['password'] }}')"
                                        class="px-2.5 py-1 bg-big-gold-dark/20 hover:bg-big-gold-dark/30 text-big-gold-light text-xs font-semibold rounded transition-all">
                                    Use
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="mt-6 text-center">
                <a href="{{ url('/') }}" class="text-slate-500 hover:text-slate-300 text-xs">← Back to public website</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
