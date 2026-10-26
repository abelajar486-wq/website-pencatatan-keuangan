<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'GRAVIX') }} — Vault Underground</title>

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600;700&family=Permanent+Marker&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Syne:wght@600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-void-pattern min-h-screen font-sans text-gray-200 antialiased selection:bg-emerald-500 selection:text-black">
        <div class="min-h-screen flex flex-col justify-center items-center p-4 sm:p-6 relative overflow-hidden">
            <!-- Background Spooky & Abstract Glow Accents -->
            <div class="absolute -top-32 -left-32 w-96 h-96 bg-purple-900/20 rounded-full blur-[120px] pointer-events-none"></div>
            <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-emerald-900/20 rounded-full blur-[120px] pointer-events-none"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-rose-950/10 rounded-full blur-[160px] pointer-events-none"></div>

            <div class="relative z-10 w-full max-w-md">
                <div class="text-center mb-6">
                    <a href="{{ route('home') }}" class="inline-flex flex-col items-center group">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-emerald-500 via-purple-600 to-rose-600 p-[2px] shadow-[0_0_30px_rgba(0,255,136,0.2)] group-hover:scale-105 transition-transform duration-300">
                            <div class="w-full h-full bg-[#0a0c12] rounded-[14px] flex items-center justify-center">
                                <span class="font-graffiti text-emerald-400 text-3xl font-bold group-hover:rotate-12 transition-transform">G</span>
                            </div>
                        </div>
                        <h1 class="mt-3 font-graffiti text-3xl tracking-widest text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-zinc-200 to-purple-400">
                            GRAVIX
                        </h1>
                        <p class="text-xs font-mono text-zinc-500 tracking-widest uppercase mt-0.5">
                            Underground Financial Vault
                        </p>
                    </a>
                </div>

                <div class="graffiti-card p-6 sm:p-8 rounded-2xl border border-white/10 shadow-2xl relative">
                    <!-- Corner stencil tag marks -->
                    <div class="absolute top-2 left-2 w-2 h-2 border-t-2 border-l-2 border-emerald-500/60"></div>
                    <div class="absolute top-2 right-2 w-2 h-2 border-t-2 border-r-2 border-purple-500/60"></div>
                    <div class="absolute bottom-2 left-2 w-2 h-2 border-b-2 border-l-2 border-rose-500/60"></div>
                    <div class="absolute bottom-2 right-2 w-2 h-2 border-b-2 border-r-2 border-emerald-500/60"></div>

                    {{ $slot }}
                </div>

                <div class="mt-6 text-center text-xs font-mono text-zinc-500">
                    <a href="{{ route('home') }}" class="hover:text-emerald-400 transition flex items-center justify-center gap-1">
                        <span>← Kembali ke Halaman Utama</span>
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>
