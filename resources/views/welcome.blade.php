<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GRAVIX — Street Graffiti & Abstract Underground Finance</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600;700&family=Permanent+Marker&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-void-pattern min-h-screen text-zinc-100 font-sans selection:bg-emerald-500 selection:text-black overflow-x-hidden">
    <!-- Ambient Street Glows -->
    <div class="fixed top-0 left-1/4 w-[500px] h-[500px] bg-emerald-600/10 rounded-full blur-[140px] pointer-events-none"></div>
    <div class="fixed bottom-0 right-1/4 w-[600px] h-[600px] bg-purple-700/10 rounded-full blur-[160px] pointer-events-none"></div>
    <div class="fixed top-1/3 right-10 w-[400px] h-[400px] bg-rose-700/10 rounded-full blur-[140px] pointer-events-none"></div>

    <!-- Top Navigation Bar -->
    <header class="border-b border-white/10 bg-black/50 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-gradient-to-tr from-emerald-500 via-purple-600 to-rose-600 p-[1.5px] shadow-[0_0_20px_rgba(0,255,136,0.25)]">
                    <div class="w-full h-full bg-[#090b10] rounded-[10px] flex items-center justify-center">
                        <span class="font-graffiti text-emerald-400 text-2xl font-bold">G</span>
                    </div>
                </div>
                <div>
                    <span class="font-graffiti text-2xl tracking-wider text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-teal-300 to-purple-400">
                        GRAVIX
                    </span>
                    <span class="block text-[10px] font-mono tracking-widest text-zinc-500 uppercase -mt-1 font-semibold">
                        UNDERGROUND VAULT
                    </span>
                </div>
            </div>

            <div class="flex items-center gap-3">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 rounded-xl bg-emerald-500 text-black font-bold text-sm tracking-wide hover:bg-emerald-400 transition graffiti-glow-green">
                            Masuk ke Dashboard →
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 rounded-xl text-zinc-300 hover:text-white hover:bg-zinc-800 text-sm font-medium transition border border-transparent hover:border-zinc-700">
                            Masuk (Log In)
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-4 py-2 rounded-xl bg-emerald-500 text-black font-bold text-sm hover:bg-emerald-400 transition graffiti-glow-green">
                                Buat Akun Baru
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24 relative z-10">
        <div class="text-center max-w-3xl mx-auto">
            <!-- Badge Stencil Tag -->
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-zinc-900/90 border border-zinc-700/80 text-emerald-400 text-xs font-mono tracking-widest uppercase mb-8">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span>Pencatatan Keuangan</span>
            </div>

            <h1 class="font-graffiti text-4xl sm:text-6xl lg:text-7xl font-extrabold tracking-wide text-white leading-tight uppercase">
                Pencatatan Keuangan
            </h1>

            <p class="mt-6 text-zinc-400 text-base sm:text-lg leading-relaxed font-sans max-w-2xl mx-auto">
                Pantau pemasukan, pengeluaran, saldo, dan kelola catatan keuangan pribadi dengan mudah.
            </p>

            <!-- Action Buttons -->
            <div class="mt-10 flex flex-wrap items-center justify-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="px-8 py-4 rounded-xl bg-emerald-500 text-black font-bold text-base hover:bg-emerald-400 transition shadow-[0_0_30px_rgba(0,255,136,0.3)]">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('register') }}" class="px-8 py-4 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-400 text-black font-extrabold text-base hover:brightness-110 transition shadow-[0_0_30px_rgba(0,255,136,0.35)]">
                        Daftar
                    </a>
                    <a href="{{ route('login') }}" class="px-8 py-4 rounded-xl bg-zinc-900/90 text-zinc-200 border border-zinc-700 font-semibold text-base hover:bg-zinc-800 transition">
                        Masuk
                    </a>
                @endauth
            </div>
        </div>

        <!-- Demo Accounts Box -->
        <div class="mt-16 max-w-2xl mx-auto graffiti-card p-6 rounded-2xl border border-white/10 relative">
            <div class="flex items-center justify-between border-b border-white/10 pb-3 mb-4">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-rose-500 animate-pulse"></span>
                    <span class="text-xs font-mono uppercase tracking-widest text-zinc-300 font-bold">AKUN DEMO SIAP PAKAI</span>
                </div>
                <span class="text-[11px] font-mono text-zinc-500">Spatie Laravel-Permission RBAC</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs font-mono">
                <div class="p-3.5 rounded-xl bg-rose-950/30 border border-rose-900/50">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-rose-400 font-bold uppercase tracking-wider">ADMINISTRATOR</span>
                        <span class="px-1.5 py-0.5 rounded bg-rose-500/20 text-rose-300 text-[10px]">Role: admin</span>
                    </div>
                    <div class="text-zinc-300">Email: <span class="text-white font-semibold">admin@catatankeuangan.com</span></div>
                    <div class="text-zinc-300">Password: <span class="text-white font-semibold">password</span></div>
                    <div class="text-[10px] text-zinc-500 mt-2">Dapat melihat dan mengelola semua user serta audit transaksi.</div>
                </div>

                <div class="p-3.5 rounded-xl bg-emerald-950/30 border border-emerald-900/50">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-emerald-400 font-bold uppercase tracking-wider">USER PENGGUNA</span>
                        <span class="px-1.5 py-0.5 rounded bg-emerald-500/20 text-emerald-300 text-[10px]">Role: user</span>
                    </div>
                    <div class="text-zinc-300">Email: <span class="text-white font-semibold">user@catatankeuangan.com</span></div>
                    <div class="text-zinc-300">Password: <span class="text-white font-semibold">password</span></div>
                    <div class="text-[10px] text-zinc-500 mt-2">Mencatat keuangan pribadi, isi saldo, dan buat kategori sendiri.</div>
                </div>
            </div>
        </div>

        <!-- Features Showcase Grid -->
        <div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="graffiti-card p-6 rounded-2xl relative overflow-hidden group">
                <div class="w-12 h-12 rounded-xl bg-emerald-500/10 border border-emerald-500/30 flex items-center justify-center text-emerald-400 mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="font-bold text-lg text-white mb-2 font-display">Isi Saldo & Neraca Otomatis</h3>
                <p class="text-zinc-400 text-sm leading-relaxed">
                    Pengguna dapat melakukan top up saldo kapan saja, dengan rekapitulasi real-time antara total pemasukan, total pengeluaran, dan sisa saldo.
                </p>
            </div>

            <div class="graffiti-card p-6 rounded-2xl relative overflow-hidden group">
                <div class="w-12 h-12 rounded-xl bg-purple-500/10 border border-purple-500/30 flex items-center justify-center text-purple-400 mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                </div>
                <h3 class="font-bold text-lg text-white mb-2 font-display">Kategori Tag Kustom</h3>
                <p class="text-zinc-400 text-sm leading-relaxed">
                    Pilih kategori bawaan atau spray tag kategori baru Anda sendiri dengan palet warna neon personal untuk mengorganisir pos keuangan.
                </p>
            </div>

            <div class="graffiti-card p-6 rounded-2xl relative overflow-hidden group">
                <div class="w-12 h-12 rounded-xl bg-rose-500/10 border border-rose-500/30 flex items-center justify-center text-rose-400 mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <h3 class="font-bold text-lg text-white mb-2 font-display">Panel Admin & Keamanan Ketat</h3>
                <p class="text-zinc-400 text-sm leading-relaxed">
                    Setiap user hanya berhak mengakses datanya sendiri. Admin memiliki kuasa penuh mengontrol user, menonaktifkan, atau menghapus akun.
                </p>
            </div>
        </div>
    </main>
</body>
</html>
