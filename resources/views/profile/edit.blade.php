<x-app-layout>
    <x-slot name="header">
        <div>
            <div class="flex items-center gap-2 text-xs font-mono tracking-widest text-emerald-400 uppercase">
                <span class="inline-block w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span>PENGATURAN IDENTITAS</span>
            </div>
            <h2 class="font-graffiti text-2xl sm:text-3xl text-white tracking-wide mt-1">
                Profil <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-teal-300 to-purple-400">Pengguna Vault</span>
            </h2>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <!-- Informasi Akun -->
        <div class="graffiti-card p-6 sm:p-8 rounded-2xl border border-white/10">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- Update Password -->
        <div class="graffiti-card p-6 sm:p-8 rounded-2xl border border-white/10">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <!-- Hapus Akun -->
        <div class="graffiti-card p-6 sm:p-8 rounded-2xl border border-rose-500/20 graffiti-card-danger">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
