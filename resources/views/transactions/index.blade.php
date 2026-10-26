<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 text-xs font-mono tracking-widest text-emerald-400 uppercase">
                    <span class="inline-block w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>LOG TRANSAKSI VAULT</span>
                </div>
                <h2 class="font-graffiti text-2xl sm:text-3xl text-white tracking-wide mt-1">
                    Catatan <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-teal-300 to-rose-400">Pemasukan & Pengeluaran</span>
                </h2>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('transactions.create', ['type' => 'income']) }}" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-emerald-500/10 text-emerald-400 border border-emerald-500/30 hover:bg-emerald-500 hover:text-black font-bold text-xs uppercase tracking-wider transition graffiti-glow-green">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                    + Pemasukan
                </a>
                <a href="{{ route('transactions.create', ['type' => 'expense']) }}" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-rose-500/10 text-rose-400 border border-rose-500/30 hover:bg-rose-500 hover:text-black font-bold text-xs uppercase tracking-wider transition graffiti-glow-red">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 12H4"></path></svg>
                    - Pengeluaran
                </a>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <!-- Quick Financial Balance Overview Strip -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="graffiti-card p-4 rounded-xl border border-emerald-500/20 flex items-center justify-between">
                <div>
                    <div class="text-[10px] font-mono uppercase text-emerald-400 font-bold">Saldo Saat Ini</div>
                    <div class="text-xl font-bold font-mono-numbers text-white">Rp {{ number_format($currentBalance, 0, ',', '.') }}</div>
                </div>
                <div class="p-2.5 rounded-lg bg-emerald-500/10 text-emerald-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>

            <div class="graffiti-card p-4 rounded-xl border border-teal-500/20 flex items-center justify-between">
                <div>
                    <div class="text-[10px] font-mono uppercase text-teal-400 font-bold">Total Pemasukan</div>
                    <div class="text-xl font-bold font-mono-numbers text-emerald-400">+Rp {{ number_format($totalIncome, 0, ',', '.') }}</div>
                </div>
                <div class="p-2.5 rounded-lg bg-teal-500/10 text-teal-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path></svg>
                </div>
            </div>

            <div class="graffiti-card p-4 rounded-xl border border-rose-500/20 flex items-center justify-between">
                <div>
                    <div class="text-[10px] font-mono uppercase text-rose-400 font-bold">Total Pengeluaran</div>
                    <div class="text-xl font-bold font-mono-numbers text-rose-400">-Rp {{ number_format($totalExpense, 0, ',', '.') }}</div>
                </div>
                <div class="p-2.5 rounded-lg bg-rose-500/10 text-rose-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"></path></svg>
                </div>
            </div>
        </div>

        <!-- Filter & Search Toolbar -->
        <div class="graffiti-card p-5 rounded-2xl border border-white/10">
            <form method="GET" action="{{ route('transactions.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3 items-end">
                <!-- Filter Type -->
                <div>
                    <label class="block text-[11px] font-mono uppercase tracking-wider text-zinc-400 mb-1">Tipe Transaksi</label>
                    <select name="type" class="w-full px-3 py-2 rounded-xl bg-zinc-900 border border-zinc-700 text-sm text-zinc-200 font-mono focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                        <option value="">Semua Tipe</option>
                        <option value="income" {{ request('type') === 'income' ? 'selected' : '' }}>+ Pemasukan</option>
                        <option value="expense" {{ request('type') === 'expense' ? 'selected' : '' }}>- Pengeluaran</option>
                    </select>
                </div>

                <!-- Filter Category -->
                <div>
                    <label class="block text-[11px] font-mono uppercase tracking-wider text-zinc-400 mb-1">Kategori Tag</label>
                    <select name="category_id" class="w-full px-3 py-2 rounded-xl bg-zinc-900 border border-zinc-700 text-sm text-zinc-200 font-mono focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }} ({{ $cat->type === 'income' ? 'Masuk' : ($cat->type === 'expense' ? 'Keluar' : 'Umum') }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Date Range -->
                <div>
                    <label class="block text-[11px] font-mono uppercase tracking-wider text-zinc-400 mb-1">Dari Tanggal</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}" class="w-full px-3 py-2 rounded-xl bg-zinc-900 border border-zinc-700 text-sm text-zinc-200 font-mono focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                </div>

                <div>
                    <label class="block text-[11px] font-mono uppercase tracking-wider text-zinc-400 mb-1">Sampai Tanggal</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}" class="w-full px-3 py-2 rounded-xl bg-zinc-900 border border-zinc-700 text-sm text-zinc-200 font-mono focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                </div>

                <!-- Search & Actions -->
                <div class="flex items-center gap-2">
                    <button type="submit" class="flex-1 px-4 py-2 rounded-xl bg-emerald-500 text-black font-bold text-xs uppercase tracking-wider hover:bg-emerald-400 transition graffiti-glow-green">
                        Filter
                    </button>
                    @if(request()->hasAny(['type', 'category_id', 'start_date', 'end_date', 'search']))
                        <a href="{{ route('transactions.index') }}" class="px-3 py-2 rounded-xl bg-zinc-800 text-zinc-400 hover:text-white text-xs font-mono uppercase tracking-wider transition" title="Reset Filter">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Transactions Table -->
        <div class="graffiti-card p-6 rounded-2xl border border-white/10">
            @if($transactions->isEmpty())
                <div class="py-16 text-center">
                    <div class="w-16 h-16 rounded-2xl bg-zinc-900 border border-zinc-800 flex items-center justify-center text-zinc-600 mx-auto mb-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <h3 class="text-base font-bold text-white font-display">Tidak Ada Transaksi Ditemukan</h3>
                    <p class="text-xs text-zinc-500 font-mono mt-1">Coba ubah kriteria filter pencarian atau tambahkan catatan transaksi baru.</p>
                    <div class="mt-4 flex items-center justify-center gap-3">
                        <a href="{{ route('transactions.create', ['type' => 'income']) }}" class="px-4 py-2 rounded-xl bg-emerald-500 text-black font-bold text-xs uppercase tracking-wider">
                            + Pemasukan Baru
                        </a>
                        <a href="{{ route('transactions.create', ['type' => 'expense']) }}" class="px-4 py-2 rounded-xl bg-rose-500 text-white font-bold text-xs uppercase tracking-wider">
                            - Pengeluaran Baru
                        </a>
                    </div>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="border-b border-white/5 text-[11px] font-mono uppercase tracking-wider text-zinc-500">
                                <th class="pb-3.5 font-semibold">Tipe</th>
                                <th class="pb-3.5 font-semibold">Kategori</th>
                                <th class="pb-3.5 font-semibold">Deskripsi / Catatan</th>
                                <th class="pb-3.5 font-semibold">Tanggal</th>
                                <th class="pb-3.5 font-semibold text-right">Nominal (Rp)</th>
                                <th class="pb-3.5 font-semibold text-right">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach($transactions as $tx)
                                <tr class="hover:bg-white/[0.02] transition">
                                    <td class="py-4">
                                        @if($tx->type === 'income')
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md text-[10px] font-mono font-bold uppercase tracking-wider bg-emerald-500/15 text-emerald-400 border border-emerald-500/30">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 11l5-5m0 0l5 5m-5-5v12"></path></svg>
                                                Pemasukan
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md text-[10px] font-mono font-bold uppercase tracking-wider bg-rose-500/15 text-rose-400 border border-rose-500/30">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 13l-5 5m0 0l-5-5m5 5V6"></path></svg>
                                                Pengeluaran
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-4">
                                        @if($tx->category)
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium border border-zinc-700 bg-zinc-900 text-zinc-300">
                                                <span class="w-2 h-2 rounded-full" style="background-color: {{ $tx->category->color ?? '#10b981' }}"></span>
                                                {{ $tx->category->name }}
                                                @if($tx->category->user_id)
                                                    <span class="text-[9px] font-mono text-purple-400 uppercase">[Custom]</span>
                                                @endif
                                            </span>
                                        @else
                                            <span class="text-zinc-500 text-xs font-mono">Tanpa Kategori</span>
                                        @endif
                                    </td>
                                    <td class="py-4 text-zinc-200 font-medium max-w-sm">
                                        {{ $tx->description ?: '-' }}
                                    </td>
                                    <td class="py-4 font-mono text-xs text-zinc-400">
                                        {{ $tx->date->format('d M Y') }}
                                    </td>
                                    <td class="py-4 text-right font-mono-numbers font-bold text-sm {{ $tx->type === 'income' ? 'text-emerald-400' : 'text-rose-400' }}">
                                        {{ $tx->type === 'income' ? '+' : '-' }}Rp {{ number_format($tx->amount, 0, ',', '.') }}
                                    </td>
                                    <td class="py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('transactions.edit', $tx) }}" class="p-2 rounded-xl bg-zinc-800/80 text-zinc-400 hover:text-white hover:bg-zinc-700 transition" title="Edit Transaksi">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </a>
                                            <form method="POST" action="{{ route('transactions.destroy', $tx) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus catatan transaksi ini? Tindakan ini tidak dapat dibatalkan.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 rounded-xl bg-rose-950/40 text-rose-400 hover:text-white hover:bg-rose-900 transition" title="Hapus Transaksi">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-6 pt-4 border-t border-white/5">
                    {{ $transactions->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

