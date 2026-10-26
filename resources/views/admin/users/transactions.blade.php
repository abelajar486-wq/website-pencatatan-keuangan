<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <a href="{{ route('admin.users.index') }}" class="text-xs font-mono text-zinc-400 hover:text-rose-400 flex items-center gap-1 mb-2">
                    <span>← Kembali ke Manajemen User</span>
                </a>
                <h2 class="font-graffiti text-2xl sm:text-3xl text-white tracking-wide">
                    Audit Keuangan: <span class="text-transparent bg-clip-text bg-gradient-to-r from-rose-400 via-purple-300 to-emerald-400">{{ $targetUser->name }}</span>
                </h2>
                <div class="text-xs font-mono text-zinc-400 mt-1">
                    {{ $targetUser->email }} • Status: {{ $targetUser->is_active ? 'Aktif' : 'Nonaktif' }}
                </div>
            </div>
            <span class="text-xs font-mono px-3 py-1.5 rounded-full bg-rose-950/60 border border-rose-500/40 text-rose-300 font-bold uppercase tracking-wider">
                ADMIN AUDIT VIEW
            </span>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <!-- User Balance Snapshot -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="graffiti-card p-4 rounded-xl border border-white/10">
                <div class="text-[10px] font-mono uppercase text-zinc-400 font-bold">Saldo Akhir User</div>
                <div class="text-xl font-bold font-mono-numbers text-white mt-1">Rp {{ number_format($currentBalance, 0, ',', '.') }}</div>
            </div>
            <div class="graffiti-card p-4 rounded-xl border border-emerald-500/20">
                <div class="text-[10px] font-mono uppercase text-emerald-400 font-bold">Total Pemasukan</div>
                <div class="text-xl font-bold font-mono-numbers text-emerald-400 mt-1">+Rp {{ number_format($totalIncome, 0, ',', '.') }}</div>
            </div>
            <div class="graffiti-card p-4 rounded-xl border border-rose-500/20">
                <div class="text-[10px] font-mono uppercase text-rose-400 font-bold">Total Pengeluaran</div>
                <div class="text-xl font-bold font-mono-numbers text-rose-400 mt-1">-Rp {{ number_format($totalExpense, 0, ',', '.') }}</div>
            </div>
        </div>

        <!-- Transactions Table -->
        <div class="graffiti-card p-6 rounded-2xl border border-white/10">
            @if($transactions->isEmpty())
                <div class="py-12 text-center text-zinc-500 font-mono text-xs">
                    User ini belum memiliki riwayat transaksi tercatat.
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="border-b border-white/5 text-[11px] font-mono uppercase tracking-wider text-zinc-500">
                                <th class="pb-3.5 font-semibold">Tipe</th>
                                <th class="pb-3.5 font-semibold">Kategori</th>
                                <th class="pb-3.5 font-semibold">Deskripsi</th>
                                <th class="pb-3.5 font-semibold">Tanggal</th>
                                <th class="pb-3.5 font-semibold text-right">Nominal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach($transactions as $tx)
                                <tr class="hover:bg-white/[0.02] transition">
                                    <td class="py-3.5">
                                        @if($tx->type === 'income')
                                            <span class="px-2.5 py-1 rounded-md text-[10px] font-mono font-bold uppercase tracking-wider bg-emerald-500/15 text-emerald-400 border border-emerald-500/30">
                                                + Pemasukan
                                            </span>
                                        @else
                                            <span class="px-2.5 py-1 rounded-md text-[10px] font-mono font-bold uppercase tracking-wider bg-rose-500/15 text-rose-400 border border-rose-500/30">
                                                - Pengeluaran
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-3.5">
                                        @if($tx->category)
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-medium border border-zinc-700 bg-zinc-900 text-zinc-300">
                                                <span class="w-2 h-2 rounded-full" style="background-color: {{ $tx->category->color ?? '#10b981' }}"></span>
                                                {{ $tx->category->name }}
                                            </span>
                                        @else
                                            <span class="text-zinc-500 text-xs font-mono">Tanpa Kategori</span>
                                        @endif
                                    </td>
                                    <td class="py-3.5 text-zinc-200 font-medium">
                                        {{ $tx->description ?: '-' }}
                                    </td>
                                    <td class="py-3.5 font-mono text-xs text-zinc-400">
                                        {{ $tx->date->format('d M Y') }}
                                    </td>
                                    <td class="py-3.5 text-right font-mono-numbers font-bold text-sm {{ $tx->type === 'income' ? 'text-emerald-400' : 'text-rose-400' }}">
                                        {{ $tx->type === 'income' ? '+' : '-' }}Rp {{ number_format($tx->amount, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 pt-4 border-t border-white/5">
                    {{ $transactions->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

