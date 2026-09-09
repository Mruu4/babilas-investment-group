<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Dashboard' }} - Babilas Investment Group</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100"
      x-data="{
        sidebarOpen: false,
        collapsed: localStorage.getItem('big_sidebar_collapsed') === 'true',
        toggleCollapse() {
            this.collapsed = !this.collapsed;
            localStorage.setItem('big_sidebar_collapsed', this.collapsed);
        }
      }">

    <div class="min-h-screen flex">

        <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false" class="fixed inset-0 z-30 bg-black/50 lg:hidden"></div>

        <aside
            :class="[sidebarOpen ? 'translate-x-0' : '-translate-x-full', collapsed ? 'lg:w-20' : 'lg:w-64']"
            class="fixed inset-y-0 left-0 z-40 w-64 bg-big-navy-dark transform transition-all duration-200 ease-in-out
                   lg:translate-x-0 lg:static lg:inset-auto lg:flex lg:flex-col"
        >
            <div class="h-20 flex items-center justify-center border-b border-white/10 px-4 relative">
                <div x-show="!collapsed" class="bg-white/95 rounded-xl p-2.5 shadow-sm">
                    <img src="{{ asset('images/logo.png') }}" alt="Babilas Investment Group" class="h-12 w-auto">
                </div>
                <div x-show="collapsed" x-cloak class="bg-white/95 rounded-xl p-1.5 shadow-sm">
                    <img src="{{ asset('images/logo.png') }}" alt="BIG" class="h-8 w-8 object-contain">
                </div>
                <button @click="toggleCollapse()" class="hidden lg:flex absolute -right-3 top-1/2 -translate-y-1/2 w-6 h-6 bg-big-gold rounded-full items-center justify-center shadow">
                    <i :data-lucide="collapsed ? 'chevron-right' : 'chevron-left'" class="w-3.5 h-3.5 text-big-navy-dark"></i>
                </button>
            </div>

            <nav class="flex-1 overflow-y-auto overflow-x-hidden px-3 py-6 space-y-6">

                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-semibold
                          {{ request()->routeIs('dashboard') ? 'bg-big-gold text-big-navy-dark' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                    <i data-lucide="layout-dashboard" class="w-4 h-4 shrink-0"></i>
                    <span x-show="!collapsed" x-cloak>Dashboard</span>
                </a>

                <div>
                    <p x-show="!collapsed" x-cloak class="px-3 text-xs uppercase tracking-wider text-gray-400 mb-2 font-bold">Content Management</p>
                    <div class="space-y-1">
                        <a href="{{ route('admin.properties.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm {{ request()->routeIs('admin.properties.*') ? 'bg-white/10 text-white' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}"><i data-lucide="building-2" class="w-4 h-4 shrink-0"></i><span x-show="!collapsed" x-cloak>Real Estate</span></a>
                        <a href="{{ route('admin.agriculture.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm {{ request()->routeIs('admin.agriculture.*') ? 'bg-white/10 text-white' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}"><i data-lucide="sprout" class="w-4 h-4 shrink-0"></i><span x-show="!collapsed" x-cloak>Agriculture</span></a>
                        <a href="{{ route('admin.technology.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm {{ request()->routeIs('admin.technology.*') ? 'bg-white/10 text-white' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}"><i data-lucide="cpu" class="w-4 h-4 shrink-0"></i><span x-show="!collapsed" x-cloak>Technology</span></a>
                        <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-gray-300 hover:bg-white/10 hover:text-white"><i data-lucide="car" class="w-4 h-4 shrink-0"></i><span x-show="!collapsed" x-cloak>Automobiles</span></a>
                        <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-gray-300 hover:bg-white/10 hover:text-white"><i data-lucide="trending-up" class="w-4 h-4 shrink-0"></i><span x-show="!collapsed" x-cloak>Investments</span></a>
                        <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-gray-300 hover:bg-white/10 hover:text-white"><i data-lucide="folder" class="w-4 h-4 shrink-0"></i><span x-show="!collapsed" x-cloak>Portfolio</span></a>
                    </div>
                </div>

                <div>
                    <p x-show="!collapsed" x-cloak class="px-3 text-xs uppercase tracking-wider text-gray-400 mb-2 font-bold">Marketing</p>
                    <div class="space-y-1">
                        <a href="#" class="flex items-center justify-between px-3 py-2 rounded-lg text-sm text-gray-300 hover:bg-white/10 hover:text-white">
                            <span class="flex items-center gap-3"><i data-lucide="megaphone" class="w-4 h-4 shrink-0"></i><span x-show="!collapsed" x-cloak>Advertisements</span></span>
                            @if ($navBadges['advertisements'] > 0)
                            <span x-show="!collapsed" x-cloak class="text-[10px] font-bold bg-pink-500 text-white rounded-full w-5 h-5 flex items-center justify-center">{{ $navBadges['advertisements'] }}</span>
                            @endif
                        </a>
                        <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-gray-300 hover:bg-white/10 hover:text-white"><i data-lucide="newspaper" class="w-4 h-4 shrink-0"></i><span x-show="!collapsed" x-cloak>News / Blog</span></a>
                        <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-gray-300 hover:bg-white/10 hover:text-white"><i data-lucide="image" class="w-4 h-4 shrink-0"></i><span x-show="!collapsed" x-cloak>Media Library</span></a>
                    </div>
                </div>

                <div>
                    <p x-show="!collapsed" x-cloak class="px-3 text-xs uppercase tracking-wider text-gray-400 mb-2 font-bold">Communication</p>
                    <div class="space-y-1">
                        <a href="#" class="flex items-center justify-between px-3 py-2 rounded-lg text-sm text-gray-300 hover:bg-white/10 hover:text-white">
                            <span class="flex items-center gap-3"><i data-lucide="inbox" class="w-4 h-4 shrink-0"></i><span x-show="!collapsed" x-cloak>Enquiries</span></span>
                            @if ($navBadges['enquiries'] > 0)
                            <span x-show="!collapsed" x-cloak class="text-[10px] font-bold bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center">{{ $navBadges['enquiries'] }}</span>
                            @endif
                        </a>
                        <a href="#" class="flex items-center justify-between px-3 py-2 rounded-lg text-sm text-gray-300 hover:bg-white/10 hover:text-white">
                            <span class="flex items-center gap-3"><i data-lucide="mail" class="w-4 h-4 shrink-0"></i><span x-show="!collapsed" x-cloak>Contact Messages</span></span>
                            @if ($navBadges['contact_messages'] > 0)
                            <span x-show="!collapsed" x-cloak class="text-[10px] font-bold bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center">{{ $navBadges['contact_messages'] }}</span>
                            @endif
                        </a>
                    </div>
                </div>

                @role('Super Admin')
                <div>
                    <p x-show="!collapsed" x-cloak class="px-3 text-xs uppercase tracking-wider text-gray-400 mb-2 font-bold">Administration</p>
                    <div class="space-y-1">
                        <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-gray-300 hover:bg-white/10 hover:text-white"><i data-lucide="users" class="w-4 h-4 shrink-0"></i><span x-show="!collapsed" x-cloak>Users</span></a>
                        <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-gray-300 hover:bg-white/10 hover:text-white"><i data-lucide="shield-check" class="w-4 h-4 shrink-0"></i><span x-show="!collapsed" x-cloak>Roles & Permissions</span></a>
                        <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-gray-300 hover:bg-white/10 hover:text-white"><i data-lucide="settings" class="w-4 h-4 shrink-0"></i><span x-show="!collapsed" x-cloak>Settings</span></a>
                    </div>
                </div>
                @endrole

            </nav>

            <div class="border-t border-white/10 p-3">
                <div class="flex items-center gap-3 px-2 py-2 mb-1">
                    <div class="w-8 h-8 rounded-full bg-big-gold/20 text-big-gold-light flex items-center justify-center text-xs font-bold shrink-0">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    <div x-show="!collapsed" x-cloak class="min-w-0">
                        <p class="text-xs font-semibold text-white truncate">{{ auth()->user()->getRoleNames()->first() }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-red-400 hover:bg-white/10 transition">
                        <i data-lucide="log-out" class="w-4 h-4 shrink-0"></i>
                        <span x-show="!collapsed" x-cloak>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col min-w-0">

            <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-4 sm:px-6 gap-4">
                <div class="flex items-center gap-3 min-w-0">
                    <button @click="sidebarOpen = true" class="lg:hidden text-big-navy shrink-0">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                    <h1 class="text-lg font-semibold text-big-navy-dark truncate">{{ $title ?? 'Dashboard' }}</h1>
                </div>

                <div class="flex items-center gap-3 sm:gap-4 shrink-0">
                    <button class="hidden sm:flex text-gray-400 hover:text-big-navy-dark">
                        <i data-lucide="search" class="w-5 h-5"></i>
                    </button>
                    <button class="relative text-gray-400 hover:text-big-navy-dark">
                        <i data-lucide="bell" class="w-5 h-5"></i>
                        @if (($navBadges['enquiries'] ?? 0) + ($navBadges['contact_messages'] ?? 0) > 0)
                        <span class="absolute -top-1 -right-1 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white"></span>
                        @endif
                    </button>
                    <div class="flex items-center gap-2 pl-3 sm:border-l border-gray-200">
                        <span class="hidden sm:inline text-sm font-semibold text-slate-800">{{ auth()->user()->name }}</span>
                        <span class="text-[10px] font-semibold bg-big-gold/10 text-big-gold-dark px-2 py-0.5 rounded-full whitespace-nowrap">
                            {{ auth()->user()->getRoleNames()->first() }}
                        </span>
                    </div>
                </div>
            </header>

            <main class="flex-1 p-4 sm:p-6">
                {{ $slot }}
            </main>
        </div>
    </div>

</body>
</html>
