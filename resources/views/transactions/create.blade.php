<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <a href="{{ route('transactions.index') }}" class="text-xs font-mono text-zinc-400 hover:text-emerald-400 flex items-center gap-1 mb-2">
                    <span>← Kembali ke Log Transaksi</span>
                </a>
                <h2 class="font-graffiti text-2xl sm:text-3xl text-white tracking-wide">
                    Catat Transaksi <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-rose-400">Keuangan Baru</span>
                </h2>
            </div>
            <span class="text-xs font-mono px-3 py-1 rounded-full bg-zinc-900 border border-zinc-700 text-zinc-400">
                ENTRY VAULT #{{ Auth::id() }}
            </span>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-4" x-data="{
        type: '{{ old('type', $type ?? 'income') }}',
        createCustomCategory: false
    }">
        <div class="graffiti-card p-6 sm:p-8 rounded-2xl border border-white/10 shadow-2xl relative">
            <form method="POST" action="{{ route('transactions.store') }}" class="space-y-6">
                @csrf

                <!-- Type Selector (Radio Toggle) -->
                <div>
                    <label class="block text-xs font-mono uppercase tracking-wider text-zinc-300 font-bold mb-2">
                        Pilih Tipe Catatan Keuangan *
                    </label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="cursor-pointer">
                            <input type="radio" name="type" value="income" x-model="type" class="sr-only">
                            <div :class="type === 'income' ? 'bg-emerald-500/20 border-emerald-500 text-emerald-300 graffiti-glow-green font-bold' : 'bg-zinc-900 border-zinc-700 text-zinc-400 hover:border-zinc-600'" class="p-3.5 rounded-xl border text-center transition flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 11l5-5m0 0l5 5m-5-5v12"></path></svg>
                                <span>+ Pemasukan (Income)</span>
                            </div>
                        </label>

                        <label class="cursor-pointer">
                            <input type="radio" name="type" value="expense" x-model="type" class="sr-only">
                            <div :class="type === 'expense' ? 'bg-rose-500/20 border-rose-500 text-rose-300 graffiti-glow-red font-bold' : 'bg-zinc-900 border-zinc-700 text-zinc-400 hover:border-zinc-600'" class="p-3.5 rounded-xl border text-center transition flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 13l-5 5m0 0l-5-5m5 5V6"></path></svg>
                                <span>- Pengeluaran (Expense)</span>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Amount / Nominal -->
                <div>
                    <label for="amount" class="block text-xs font-mono uppercase tracking-wider text-zinc-300 font-bold mb-1.5">
                        Nominal / Jumlah (Rp) *
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center font-mono font-bold text-lg" :class="type === 'income' ? 'text-emerald-400' : 'text-rose-400'">
                            Rp
                        </span>
                        <input type="number" id="amount" name="amount" value="{{ old('amount') }}" min="1" step="any" required placeholder="0" class="w-full pl-14 pr-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700 text-white font-mono text-xl font-bold focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition">
                    </div>
                    @error('amount')
                        <p class="text-rose-400 text-xs font-mono mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category Section: Select existing OR create custom -->
                <div class="p-4 rounded-xl bg-black/40 border border-white/5 space-y-3">
                    <div class="flex items-center justify-between">
                        <label class="block text-xs font-mono uppercase tracking-wider text-zinc-300 font-bold">
                            Kategori Tag *
                        </label>
                        <button type="button" @click="createCustomCategory = !createCustomCategory" class="text-xs font-mono text-purple-400 hover:text-purple-300 underline flex items-center gap-1">
                            <span x-text="createCustomCategory ? '← Pilih dari daftar yang ada' : '+ Buat kategori baru sendiri'"></span>
                        </button>
                    </div>

                    <!-- Existing Categories Dropdown -->
                    <div x-show="!createCustomCategory">
                        <select name="category_id" class="w-full px-4 py-2.5 rounded-xl bg-zinc-900 border border-zinc-700 text-zinc-200 font-mono text-sm focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }} {{ $cat->user_id ? '(Kustom)' : '' }}
                                </option>
                            @endforeach
                        </select>
                        <p class="text-[11px] text-zinc-500 font-mono mt-1">Pilih kategori yang tersedia di vault sistem.</p>
                    </div>

                    <!-- Custom Category Input On The Fly -->
                    <div x-show="createCustomCategory" x-cloak class="p-3.5 rounded-xl bg-purple-950/20 border border-purple-500/40 space-y-2">
                        <label class="block text-[11px] font-mono uppercase text-purple-300 font-bold">
                            Nama Kategori Kustom Baru:
                        </label>
                        <input type="text" name="custom_category_name" value="{{ old('custom_category_name') }}" placeholder="Misal: Beli Cat Pilox, Kopi Senja, Saham Crypto" class="w-full px-3.5 py-2 rounded-xl bg-zinc-900 border border-purple-500/50 text-white font-mono text-sm placeholder-zinc-500 focus:border-purple-400 focus:ring-1 focus:ring-purple-400">
                        <p class="text-[11px] text-zinc-400 font-mono">Kategori ini otomatis tersimpan ke daftar kategori pribadi Anda.</p>
                    </div>
                </div>

                <!-- Date -->
                <div>
                    <label for="date" class="block text-xs font-mono uppercase tracking-wider text-zinc-300 font-bold mb-1.5">
                        Tanggal Transaksi *
                    </label>
                    <input type="date" id="date" name="date" value="{{ old('date', $today) }}" required class="w-full px-4 py-2.5 rounded-xl bg-zinc-900 border border-zinc-700 text-white font-mono text-sm focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition">
                    @error('date')
                        <p class="text-rose-400 text-xs font-mono mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description / Notes -->
                <div>
                    <label for="description" class="block text-xs font-mono uppercase tracking-wider text-zinc-300 font-bold mb-1.5">
                        Deskripsi / Keterangan (Opsional)
                    </label>
                    <textarea id="description" name="description" rows="3" placeholder="Tuliskan catatan transaksi atau keperluan pengeluaran..." class="w-full px-4 py-2.5 rounded-xl bg-zinc-900 border border-zinc-700 text-white placeholder-zinc-500 text-sm focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-rose-400 text-xs font-mono mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Form Actions -->
                <div class="pt-4 flex items-center justify-end gap-3 border-t border-white/10">
                    <a href="{{ route('transactions.index') }}" class="px-5 py-2.5 rounded-xl bg-zinc-800 text-zinc-300 hover:text-white text-xs font-mono uppercase tracking-wider transition">
                        Batal
                    </a>
                    <button type="submit" :class="type === 'income' ? 'bg-emerald-500 hover:bg-emerald-400 text-black' : 'bg-rose-500 hover:bg-rose-400 text-white'" class="px-7 py-3 rounded-xl font-bold text-xs uppercase tracking-wider transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

