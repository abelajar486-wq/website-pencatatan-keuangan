<nav x-data="{ open: false }" class="bg-black/60 backdrop-blur-xl border-b border-white/10 sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="group flex items-center gap-3">
                        <div class="relative w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 via-purple-600 to-rose-600 p-[1.5px] transition-transform duration-300 group-hover:scale-105">
                            <div class="w-full h-full bg-[#0a0c12] rounded-[10px] flex items-center justify-center">
                                <span class="font-graffiti text-emerald-400 text-xl font-bold group-hover:rotate-12 transition-transform duration-300">G</span>
                            </div>
                            <div class="absolute -bottom-1 -right-1 w-3 h-3 bg-emerald-400 rounded-full blur-[2px] animate-ping"></div>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-graffiti text-2xl font-bold tracking-wider text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-teal-300 to-purple-400 group-hover:brightness-125 transition">
                                GRAVIX
                            </span>
                            <span class="text-[10px] font-mono tracking-widest text-zinc-500 uppercase -mt-1 font-semibold">
                                VAULT // FINANCE
                            </span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-2 sm:-my-px sm:ms-10 sm:flex items-center">
                    <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/30 font-semibold' : 'text-zinc-400 hover:text-zinc-200 hover:bg-zinc-800/50' }}">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            Dashboard
                        </span>
                    </a>

                    <a href="{{ route('transactions.index') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('transactions.*') ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/30 font-semibold' : 'text-zinc-400 hover:text-zinc-200 hover:bg-zinc-800/50' }}">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            Catatan Transaksi
                        </span>
                    </a>

                    <a href="{{ route('categories.index') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('categories.*') ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/30 font-semibold' : 'text-zinc-400 hover:text-zinc-200 hover:bg-zinc-800/50' }}">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                            Kategori Tag
                        </span>
                    </a>

                    @role('admin')
                        <a href="{{ route('admin.users.index') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.*') ? 'bg-rose-500/20 text-rose-300 border border-rose-500/40 font-semibold graffiti-glow-red' : 'text-rose-400 hover:text-rose-200 hover:bg-rose-950/40 border border-rose-900/50' }}">
                            <span class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-rose-500 animate-pulse"></span>
                                Kelola User (Admin)
                            </span>
                        </a>
                    @endrole
                </div>
            </div>

            <!-- Settings & Quick Actions -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 sm:gap-3">
                <a href="{{ route('transactions.create') }}" class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-lg bg-emerald-500/10 text-emerald-400 hover:bg-emerald-500 hover:text-black border border-emerald-500/30 hover:border-emerald-400 font-semibold text-xs tracking-wider uppercase transition duration-200 graffiti-glow-green">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                    Catat Transaksi
                </a>

                <x-dropdown align="right" width="56">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-3 px-3 py-2 border border-white/10 rounded-xl bg-zinc-900/80 hover:bg-zinc-800 text-zinc-300 text-sm font-medium focus:outline-none transition ease-in-out duration-150">
                            <div class="w-7 h-7 rounded-lg bg-zinc-800 border border-zinc-700 flex items-center justify-center font-mono font-bold text-xs text-emerald-400">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <div class="text-left">
                                <div class="text-xs font-bold leading-tight">{{ Auth::user()->name }}</div>
                                <div class="text-[10px] font-mono text-zinc-500 flex items-center gap-1">
                                    @if(Auth::user()->hasRole('admin'))
                                        <span class="text-rose-400 font-bold uppercase tracking-wider">[ADMIN]</span>
                                    @else
                                        <span class="text-emerald-400 font-bold uppercase tracking-wider">[USER]</span>
                                    @endif
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-zinc-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-white/10 text-xs text-zinc-400">
                            <div>Signed in as:</div>
                            <div class="font-bold text-zinc-200 truncate">{{ Auth::user()->email }}</div>
                        </div>

                        <x-dropdown-link :href="route('profile.edit')" class="text-zinc-300 hover:text-white hover:bg-zinc-800">
                            {{ __('Profil Akun') }}
                        </x-dropdown-link>

                        @role('admin')
                            <x-dropdown-link :href="route('admin.users.index')" class="text-rose-400 hover:text-rose-300 hover:bg-rose-950/40">
                                {{ __('Panel Kelola User (Admin)') }}
                            </x-dropdown-link>
                        @endrole

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="text-rose-400 hover:text-rose-300 hover:bg-rose-950/40 border-t border-white/5">
                                {{ __('Keluar (Log Out)') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger Button -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-zinc-400 hover:text-white hover:bg-zinc-800 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-white/10 bg-black/95">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-zinc-200">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('transactions.index')" :active="request()->routeIs('transactions.*')" class="text-zinc-200">
                {{ __('Catatan Transaksi') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')" class="text-zinc-200">
                {{ __('Kategori Tag') }}
            </x-responsive-nav-link>

            @role('admin')
                <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.*')" class="text-rose-400">
                    {{ __('Kelola Semua User (Admin)') }}
                </x-responsive-nav-link>
            @endrole
        </div>

        <div class="pt-4 pb-3 border-t border-white/10 px-4">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-zinc-800 border border-zinc-700 flex items-center justify-center font-mono font-bold text-sm text-emerald-400">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <div class="font-bold text-sm text-white">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-zinc-400 font-mono">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-zinc-300">
                    {{ __('Profil Akun') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-rose-400">
                        {{ __('Keluar (Log Out)') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
