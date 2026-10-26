<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'GRAVIX') }} — Street Vault Finance</title>

        <!-- Google Fonts: Permanent Marker (Street Graffiti), Syne (Display), Plus Jakarta Sans (Clean UI), JetBrains Mono -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600;700&family=Permanent+Marker&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Syne:wght@600;700;800&display=swap" rel="stylesheet">

        <!-- Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-void-pattern min-h-screen font-sans text-gray-200 antialiased selection:bg-emerald-500 selection:text-black">
        <div class="min-h-screen flex flex-col">
            @include('layouts.navigation')

            <!-- Flash Notifications -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full mt-4">
                @if (session('success'))
                    <div x-data="{ show: true }" x-show="show" x-transition class="mb-4 flex items-center justify-between p-4 bg-emerald-950/80 border border-emerald-500/60 rounded-xl text-emerald-300 graffiti-glow-green">
                        <div class="flex items-center gap-3">
                            <span class="p-1.5 bg-emerald-500 text-black rounded-lg font-bold">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                            </span>
                            <span class="font-medium text-sm sm:text-base">{{ session('success') }}</span>
                        </div>
                        <button @click="show = false" class="text-emerald-400 hover:text-white transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                @endif

                @if (session('error'))
                    <div x-data="{ show: true }" x-show="show" x-transition class="mb-4 flex items-center justify-between p-4 bg-rose-950/80 border border-rose-500/60 rounded-xl text-rose-300 graffiti-glow-red">
                        <div class="flex items-center gap-3">
                            <span class="p-1.5 bg-rose-500 text-black rounded-lg font-bold">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </span>
                            <span class="font-medium text-sm sm:text-base">{{ session('error') }}</span>
                        </div>
                        <button @click="show = false" class="text-rose-400 hover:text-white transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                @endif

                @if ($errors->any())
                    <div x-data="{ show: true }" x-show="show" x-transition class="mb-4 p-4 bg-rose-950/80 border border-rose-500/60 rounded-xl text-rose-300">
                        <div class="flex items-center gap-2 font-semibold mb-1">
                            <svg class="w-5 h-5 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            <span>Terjadi kesalahan pada input data:</span>
                        </div>
                        <ul class="list-disc list-inside text-sm text-rose-300/90 pl-2 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <!-- Page Heading -->
            @isset($header)
                <header class="border-b border-white/5 bg-black/40 backdrop-blur-md">
                    <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-grow py-6">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="mt-auto border-t border-white/5 bg-black/60 backdrop-blur-md py-6 text-center text-xs text-zinc-500 font-mono">
                <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="flex items-center gap-2">
                        <span class="inline-block w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span class="font-graffiti tracking-wider text-zinc-400">GRAVIX // UNDERGROUND FINANCE</span>
                    </div>
                    <p class="text-zinc-600">Sistem Pencatatan Keuangan Berbasis Laravel Breeze & Spatie Permission</p>
                </div>
            </footer>
        </div>
    </body>
</html>
