<x-guest-layout>
    <div class="mb-6">
        <h2 class="font-graffiti text-2xl text-white tracking-wide">
            MASUK <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-purple-400">VAULT</span>
        </h2>
        <p class="text-xs font-mono text-zinc-400 mt-1">Akses catatan keuangan dan pantau seluruh pergerakan kas</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-mono uppercase tracking-wider text-zinc-300 font-bold mb-1">
                Alamat Email
            </label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="nama@email.com" class="w-full px-4 py-2.5 rounded-xl bg-zinc-900 border border-zinc-700 text-white font-mono text-sm placeholder-zinc-500 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition">
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-mono uppercase tracking-wider text-zinc-300 font-bold mb-1">
                Kata Sandi
            </label>
            <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" class="w-full px-4 py-2.5 rounded-xl bg-zinc-900 border border-zinc-700 text-white font-mono text-sm placeholder-zinc-500 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition">
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between text-xs font-mono">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" name="remember" class="rounded bg-zinc-900 border-zinc-700 text-emerald-500 focus:ring-emerald-500">
                <span class="ms-2 text-zinc-400">Ingat Saya</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-zinc-400 hover:text-emerald-400 underline transition" href="{{ route('password.request') }}">
                    Lupa Password?
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit" class="w-full py-3 rounded-xl bg-emerald-500 hover:bg-emerald-400 text-black font-extrabold text-xs uppercase tracking-wider transition graffiti-glow-green">
                Masuk
            </button>
        </div>

        <!-- Quick Demo Fill -->
        <div class="pt-4 border-t border-white/5 space-y-2">
            <div class="text-[10px] font-mono uppercase tracking-wider text-zinc-500 text-center font-bold">
                Isi Cepat Akun Demo:
            </div>
            <div class="grid grid-cols-2 gap-2">
                <button type="button" onclick="document.getElementById('email').value='admin@catatankeuangan.com'; document.getElementById('password').value='password';" class="px-2.5 py-1.5 rounded-lg bg-rose-950/30 border border-rose-900/50 text-[10px] font-mono text-rose-300 hover:bg-rose-900/40 text-center">
                    Demo Admin
                </button>
                <button type="button" onclick="document.getElementById('email').value='user@catatankeuangan.com'; document.getElementById('password').value='password';" class="px-2.5 py-1.5 rounded-lg bg-emerald-950/30 border border-emerald-900/50 text-[10px] font-mono text-emerald-300 hover:bg-emerald-900/40 text-center">
                    Demo User
                </button>
            </div>
        </div>

        <!-- Register Link -->
        <div class="text-center pt-2">
            <span class="text-xs text-zinc-400">Belum punya akun?</span>
            <a href="{{ route('register') }}" class="text-xs font-bold text-emerald-400 hover:underline ms-1 font-mono">
                Daftar sekarang →
            </a>
        </div>
    </form>
</x-guest-layout>
