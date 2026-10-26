<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 text-xs font-mono tracking-widest text-purple-400 uppercase">
                    <span class="inline-block w-2 h-2 rounded-full bg-purple-400 animate-pulse"></span>
                    <span>TAG ARSIP KATEGORI</span>
                </div>
                <h2 class="font-graffiti text-2xl sm:text-3xl text-white tracking-wide mt-1">
                    Kelola <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 via-pink-400 to-emerald-400">Kategori Keuangan</span>
                </h2>
            </div>
            <p class="text-xs font-mono text-zinc-400">Pilih kategori bawaan atau spray tag kategori kustom Anda sendiri</p>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Form: Tambah Kategori Kustom Baru -->
            <div class="lg:col-span-1">
                <div class="graffiti-card p-6 rounded-2xl border border-purple-500/30 graffiti-card-purple sticky top-28">
                    <div class="flex items-center gap-3 pb-4 border-b border-white/10 mb-5">
                        <div class="p-2 rounded-xl bg-purple-500/20 text-purple-400 border border-purple-500/30">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-white text-base font-display">Semprot Tag Baru</h3>
                            <p class="text-[11px] font-mono text-zinc-400">Buat kategori kustom milik Anda</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('categories.store') }}" class="space-y-4">
                        @csrf

                        <div>
                            <label for="cat_name" class="block text-xs font-mono uppercase tracking-wider text-zinc-300 font-bold mb-1">
                                Nama Kategori *
                            </label>
                            <input type="text" id="cat_name" name="name" required placeholder="Contoh: Beli Spray Can, Langganan Spotify" class="w-full px-3.5 py-2.5 rounded-xl bg-zinc-900 border border-zinc-700 text-white font-mono text-sm placeholder-zinc-500 focus:border-purple-500 focus:ring-1 focus:ring-purple-500">
                        </div>

                        <div>
                            <label class="block text-xs font-mono uppercase tracking-wider text-zinc-300 font-bold mb-1">
                                Berlaku Untuk *
                            </label>
                            <select name="type" class="w-full px-3.5 py-2.5 rounded-xl bg-zinc-900 border border-zinc-700 text-zinc-200 font-mono text-sm focus:border-purple-500 focus:ring-1 focus:ring-purple-500">
                                <option value="expense">Hanya Pengeluaran (Expense)</option>
                                <option value="income">Hanya Pemasukan (Income)</option>
                                <option value="both">Keduanya (Pemasukan & Pengeluaran)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-mono uppercase tracking-wider text-zinc-300 font-bold mb-1">
                                Warna Tag Spray
                            </label>
                            <div class="flex items-center gap-3">
                                <input type="color" name="color" value="#a855f7" class="w-10 h-10 rounded-xl bg-transparent border-0 cursor-pointer">
                                <span class="text-xs font-mono text-zinc-400">Pilih warna spray untuk identitas visual</span>
                            </div>
                        </div>

                        <button type="submit" class="w-full mt-2 py-3 rounded-xl bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold text-xs uppercase tracking-wider hover:brightness-110 transition shadow-[0_0_20px_rgba(168,85,247,0.3)]">
                            + Buat Kategori Kustom
                        </button>
                    </form>
                </div>
            </div>

            <!-- List Kategori -->
            <div class="lg:col-span-2 space-y-8">
                <!-- User's Custom Categories -->
                <div class="graffiti-card p-6 rounded-2xl border border-white/10">
                    <div class="flex items-center justify-between pb-4 border-b border-white/10 mb-4">
                        <div>
                            <h3 class="font-display font-bold text-base text-white flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded bg-purple-400"></span>
                                Kategori Kustom Buatan Anda
                            </h3>
                            <p class="text-xs font-mono text-zinc-400 mt-0.5">Kategori personal yang Anda buat sendiri</p>
                        </div>
                        <span class="px-2.5 py-1 rounded-full bg-purple-950/60 border border-purple-500/40 text-purple-300 font-mono text-xs font-bold">
                            {{ $userCategories->count() }} Tag
                        </span>
                    </div>

                    @if($userCategories->isEmpty())
                        <div class="py-8 text-center bg-black/20 rounded-xl border border-dashed border-zinc-800">
                            <p class="text-xs font-mono text-zinc-500">Anda belum membuat kategori kustom sendiri.</p>
                            <p class="text-[11px] font-mono text-zinc-600 mt-1">Gunakan formulir di samping untuk menambahkan kategori baru.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach($userCategories as $cat)
                                <div class="p-3.5 rounded-xl bg-zinc-900/80 border border-zinc-800 flex items-center justify-between hover:border-purple-500/40 transition group">
                                    <div class="flex items-center gap-3">
                                        <span class="w-3.5 h-3.5 rounded-full shrink-0 shadow-sm" style="background-color: {{ $cat->color ?? '#a855f7' }}"></span>
                                        <div>
                                            <div class="text-sm font-bold text-white font-sans">{{ $cat->name }}</div>
                                            <div class="text-[10px] font-mono text-zinc-400">
                                                {{ $cat->type === 'income' ? 'Pemasukan' : ($cat->type === 'expense' ? 'Pengeluaran' : 'Semua') }} • {{ $cat->transactions_count }} transaksi
                                            </div>
                                        </div>
                                    </div>
                                    <form method="POST" action="{{ route('categories.destroy', $cat) }}" onsubmit="return confirm('Hapus kategori kustom ini? Transaksi terkait tidak akan dihapus.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 rounded-lg text-zinc-500 hover:text-rose-400 hover:bg-rose-950/40 transition opacity-80 group-hover:opacity-100" title="Hapus Kategori">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Default System Categories -->
                <div class="graffiti-card p-6 rounded-2xl border border-white/10">
                    <div class="flex items-center justify-between pb-4 border-b border-white/10 mb-4">
                        <div>
                            <h3 class="font-display font-bold text-base text-white flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded bg-emerald-400"></span>
                                Kategori Standar Sistem
                            </h3>
                            <p class="text-xs font-mono text-zinc-400 mt-0.5">Disediakan otomatis oleh sistem untuk semua pengguna</p>
                        </div>
                        <span class="px-2.5 py-1 rounded-full bg-zinc-900 border border-zinc-700 text-zinc-400 font-mono text-xs font-bold">
                            {{ $defaultCategories->count() }} Tag
                        </span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @foreach($defaultCategories as $cat)
                            <div class="p-3.5 rounded-xl bg-zinc-900/50 border border-zinc-800/80 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <span class="w-3.5 h-3.5 rounded-full shrink-0" style="background-color: {{ $cat->color ?? '#10b981' }}"></span>
                                    <div>
                                        <div class="text-sm font-semibold text-zinc-200">{{ $cat->name }}</div>
                                        <div class="text-[10px] font-mono text-zinc-500">
                                            {{ $cat->type === 'income' ? '+ Pemasukan' : '- Pengeluaran' }} • Digunakan {{ $cat->transactions_count }} kali
                                        </div>
                                    </div>
                                </div>
                                <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-zinc-800 text-zinc-400 uppercase">
                                    Sistem
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

