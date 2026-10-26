<x-guest-layout>
    <div class="mb-6">
        <h2 class="font-graffiti text-2xl text-white tracking-wide">
            DAFTAR <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-purple-400">VAULT BARU</span>
        </h2>
        <p class="text-xs font-mono text-zinc-400 mt-1">Buat akun untuk mulai mencatat keuangan pribadi Anda</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-xs font-mono uppercase tracking-wider text-zinc-300 font-bold mb-1">
                Nama Lengkap / Alias
            </label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Misal: Alex Streetwalker" class="w-full px-4 py-2.5 rounded-xl bg-zinc-900 border border-zinc-700 text-white font-mono text-sm placeholder-zinc-500 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition">
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-mono uppercase tracking-wider text-zinc-300 font-bold mb-1">
                Alamat Email
            </label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="nama@email.com" class="w-full px-4 py-2.5 rounded-xl bg-zinc-900 border border-zinc-700 text-white font-mono text-sm placeholder-zinc-500 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition">
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-mono uppercase tracking-wider text-zinc-300 font-bold mb-1">
                Kata Sandi
            </label>
            <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter" class="w-full px-4 py-2.5 rounded-xl bg-zinc-900 border border-zinc-700 text-white font-mono text-sm placeholder-zinc-500 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition">
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-xs font-mono uppercase tracking-wider text-zinc-300 font-bold mb-1">
                Konfirmasi Kata Sandi
            </label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ketik ulang kata sandi" class="w-full px-4 py-2.5 rounded-xl bg-zinc-900 border border-zinc-700 text-white font-mono text-sm placeholder-zinc-500 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit" class="w-full py-3 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-400 hover:brightness-110 text-black font-extrabold text-xs uppercase tracking-wider transition graffiti-glow-green">
                Daftar
            </button>
        </div>

        <!-- Login Link -->
        <div class="text-center pt-3 border-t border-white/5">
            <span class="text-xs text-zinc-400">Sudah memiliki akun?</span>
            <a href="{{ route('login') }}" class="text-xs font-bold text-emerald-400 hover:underline ms-1 font-mono">
                Masuk ke Vault →
            </a>
        </div>
    </form>
</x-guest-layout>
