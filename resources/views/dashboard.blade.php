<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 text-xs font-mono tracking-widest text-emerald-400 uppercase">
                    <span class="inline-block w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>VAULT TERMINAL // STATUS AKTIF</span>
                </div>
                <h2 class="font-graffiti text-2xl sm:text-3xl text-white tracking-wide mt-1">
                    Halo, <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-200">{{ Auth::user()->name }}</span>
                </h2>
            </div>

            <!-- Quick Action Buttons -->
            <div x-data="{ topupModalOpen: false }" class="flex flex-wrap items-center gap-2">
                <!-- Top Up / Isi Saldo Trigger -->
                <button @click="topupModalOpen = true" type="button" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-400 text-black font-extrabold text-xs uppercase tracking-wider hover:brightness-110 transition graffiti-glow-green">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    Isi Saldo (Top Up)
                </button>

                <a href="{{ route('transactions.create', ['type' => 'income']) }}" class="inline-flex items-center gap-2 px-3.5 py-2.5 rounded-xl bg-zinc-900 border border-emerald-500/40 text-emerald-400 hover:bg-emerald-500/10 font-bold text-xs uppercase tracking-wider transition">
                    + Pemasukan
                </a>

                <a href="{{ route('transactions.create', ['type' => 'expense']) }}" class="inline-flex items-center gap-2 px-3.5 py-2.5 rounded-xl bg-zinc-900 border border-rose-500/40 text-rose-400 hover:bg-rose-500/10 font-bold text-xs uppercase tracking-wider transition">
                    - Pengeluaran
                </a>

                <!-- Top Up Modal -->
                <div x-show="topupModalOpen" x-cloak class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                        <!-- Backdrop -->
                        <div x-show="topupModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black/80 backdrop-blur-md transition-opacity" @click="topupModalOpen = false"></div>

                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                        <div x-show="topupModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-[#0c0e17] border border-emerald-500/40 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full graffiti-glow-green relative">
                            <!-- Stencil Tag Border -->
                            <div class="p-6">
                                <div class="flex items-center justify-between pb-4 border-b border-white/10">
                                    <div class="flex items-center gap-3">
                                        <div class="p-2.5 rounded-xl bg-emerald-500/20 text-emerald-400 border border-emerald-500/30">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                        </div>
                                        <div>
                                            <h3 class="font-graffiti text-xl text-white tracking-wide" id="modal-title">ISI SALDO VAULT</h3>
                                            <p class="text-xs text-zinc-400 font-mono">Tambahkan saldo langsung ke dompet keuangan</p>
                                        </div>
                                    </div>
                                    <button @click="topupModalOpen = false" class="text-zinc-400 hover:text-white p-1">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </div>

                                <form method="POST" action="{{ route('saldo.topup') }}" class="mt-5 space-y-4">
                                    @csrf
                                    <div>
                                        <label for="amount" class="block text-xs font-mono text-zinc-300 uppercase tracking-wider mb-1">Jumlah Saldo (Rp) *</label>
                                        <div class="relative">
                                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-emerald-400 font-mono font-bold">Rp</span>
                                            <input type="number" id="topup_amount" name="amount" min="1000" step="1000" required placeholder="Contoh: 1000000" class="w-full pl-12 pr-4 py-2.5 rounded-xl bg-zinc-900 border border-zinc-700 text-white font-mono focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition">
                                        </div>
                                        <!-- Quick Presets -->
                                        <div class="flex flex-wrap gap-2 mt-2">
                                            <button type="button" onclick="document.getElementById('topup_amount').value = 50000" class="px-2.5 py-1 text-[11px] font-mono rounded bg-zinc-800 text-zinc-300 hover:bg-emerald-500/20 hover:text-emerald-300 transition">+50.000</button>
                                            <button type="button" onclick="document.getElementById('topup_amount').value = 100000" class="px-2.5 py-1 text-[11px] font-mono rounded bg-zinc-800 text-zinc-300 hover:bg-emerald-500/20 hover:text-emerald-300 transition">+100.000</button>
                                            <button type="button" onclick="document.getElementById('topup_amount').value = 500000" class="px-2.5 py-1 text-[11px] font-mono rounded bg-zinc-800 text-zinc-300 hover:bg-emerald-500/20 hover:text-emerald-300 transition">+500.000</button>
                                            <button type="button" onclick="document.getElementById('topup_amount').value = 1000000" class="px-2.5 py-1 text-[11px] font-mono rounded bg-zinc-800 text-zinc-300 hover:bg-emerald-500/20 hover:text-emerald-300 transition">+1.000.000</button>
                                        </div>
                                    </div>

                                    <div>
                                        <label for="date" class="block text-xs font-mono text-zinc-300 uppercase tracking-wider mb-1">Tanggal Transaksi</label>
                                        <input type="date" name="date" value="{{ date('Y-m-d') }}" class="w-full px-3.5 py-2.5 rounded-xl bg-zinc-900 border border-zinc-700 text-white font-mono focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition">
                                    </div>

                                    <div>
                                        <label for="description" class="block text-xs font-mono text-zinc-300 uppercase tracking-wider mb-1">Catatan / Keterangan</label>
                                        <input type="text" name="description" placeholder="Misal: Top up via transfer bank / gaji awal" class="w-full px-3.5 py-2.5 rounded-xl bg-zinc-900 border border-zinc-700 text-white placeholder-zinc-500 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition">
                                    </div>

                                    <div class="pt-4 flex items-center justify-end gap-3 border-t border-white/10">
                                        <button @click="topupModalOpen = false" type="button" class="px-4 py-2 rounded-xl text-zinc-400 hover:text-white text-xs font-mono uppercase tracking-wider">
                                            Batal
                                        </button>
                                        <button type="submit" class="px-5 py-2.5 rounded-xl bg-emerald-500 text-black font-bold text-xs uppercase tracking-wider hover:bg-emerald-400 transition graffiti-glow-green">
                                            Konfirmasi Isi Saldo
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        <!-- 3 Primary Metric Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Saldo Saat Ini -->
            <div class="graffiti-card p-6 rounded-2xl relative overflow-hidden border border-emerald-500/30 graffiti-glow-green">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-xs font-mono font-bold tracking-widest text-emerald-400 uppercase flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                        SALDO SAAT INI
                    </span>
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-mono uppercase font-bold {{ $currentBalance >= 0 ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/40' : 'bg-rose-500/20 text-rose-300 border border-rose-500/40' }}">
                        {{ $currentBalance >= 0 ? 'STATUS: SURPLUS' : 'STATUS: DEFISIT' }}
                    </span>
                </div>
                <div class="font-mono-numbers text-3xl sm:text-4xl font-extrabold tracking-tight text-white">
                    Rp {{ number_format($currentBalance, 0, ',', '.') }}
                </div>
                <p class="text-xs text-zinc-400 font-mono mt-3 flex items-center gap-1.5">
                    <span>Bersih dari total pemasukan dikurangi pengeluaran</span>
                </p>
                <!-- Decorative Spray Tag -->
                <div class="absolute -right-4 -bottom-4 font-graffiti text-6xl text-white/[0.03] select-none pointer-events-none">
                    VAULT
                </div>
            </div>

            <!-- Total Pemasukan -->
            <div class="graffiti-card p-6 rounded-2xl relative overflow-hidden border border-teal-500/20">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-xs font-mono font-bold tracking-widest text-teal-400 uppercase flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 11l5-5m0 0l5 5m-5-5v12"></path></svg>
                        TOTAL PEMASUKAN
                    </span>
                    <span class="px-2 py-0.5 rounded text-[10px] font-mono bg-teal-500/10 text-teal-300 border border-teal-500/30">
                        Masuk
                    </span>
                </div>
                <div class="font-mono-numbers text-3xl sm:text-4xl font-extrabold tracking-tight text-emerald-400">
                    +Rp {{ number_format($totalIncome, 0, ',', '.') }}
                </div>
                <p class="text-xs text-zinc-400 font-mono mt-3">
                    Termasuk gaji, usaha, dan isi saldo
                </p>
                <div class="absolute -right-4 -bottom-4 font-graffiti text-6xl text-emerald-500/[0.03] select-none pointer-events-none">
                    INCOME
                </div>
            </div>

            <!-- Total Pengeluaran -->
            <div class="graffiti-card p-6 rounded-2xl relative overflow-hidden border border-rose-500/20 graffiti-card-danger">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-xs font-mono font-bold tracking-widest text-rose-400 uppercase flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 13l-5 5m0 0l-5-5m5 5V6"></path></svg>
                        TOTAL PENGELUARAN
                    </span>
                    <span class="px-2 py-0.5 rounded text-[10px] font-mono bg-rose-500/10 text-rose-300 border border-rose-500/30">
                        Keluar
                    </span>
                </div>
                <div class="font-mono-numbers text-3xl sm:text-4xl font-extrabold tracking-tight text-rose-400">
                    -Rp {{ number_format($totalExpense, 0, ',', '.') }}
                </div>
                <p class="text-xs text-zinc-400 font-mono mt-3">
                    Biaya hidup, belanja, dan operasional
                </p>
                <div class="absolute -right-4 -bottom-4 font-graffiti text-6xl text-rose-500/[0.03] select-none pointer-events-none">
                    BURN
                </div>
            </div>
        </div>

        <!-- Cashflow Chart -->
        <div class="graffiti-card p-6 rounded-2xl border border-white/10 relative">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pb-4 border-b border-white/10 gap-2 mb-6">
                <div>
                    <h3 class="font-display font-bold text-lg text-white flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded bg-purple-500"></span>
                        Arus Kas 6 Bulan Terakhir
                    </h3>
                    <p class="text-xs font-mono text-zinc-400 mt-0.5">Tren komparasi pemasukan vs pengeluaran</p>
                </div>
                <div class="flex items-center gap-4 text-xs font-mono">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-emerald-400"></span>
                        <span class="text-zinc-300">Pemasukan</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-rose-500"></span>
                        <span class="text-zinc-300">Pengeluaran</span>
                    </div>
                </div>
            </div>

            <div class="h-64 sm:h-72 w-full">
                <canvas id="cashflowChart"></canvas>
            </div>
        </div>

        <!-- Recent Transactions Table Section -->
        <div class="graffiti-card p-6 rounded-2xl border border-white/10">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pb-4 border-b border-white/10 gap-3 mb-4">
                <div>
                    <h3 class="font-display font-bold text-lg text-white flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded bg-emerald-400"></span>
                        Catatan Transaksi Terbaru
                    </h3>
                    <p class="text-xs font-mono text-zinc-400 mt-0.5">8 aktivitas keuangan paling mutakhir di akun Anda</p>
                </div>
                <a href="{{ route('transactions.index') }}" class="text-xs font-mono font-bold text-emerald-400 hover:text-emerald-300 uppercase tracking-wider flex items-center gap-1 group">
                    <span>Lihat Semua Catatan</span>
                    <span class="group-hover:translate-x-1 transition-transform">→</span>
                </a>
            </div>

            @if($recentTransactions->isEmpty())
                <div class="py-12 text-center">
                    <div class="w-16 h-16 rounded-2xl bg-zinc-900 border border-zinc-800 flex items-center justify-center text-zinc-600 mx-auto mb-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    </div>
                    <p class="text-zinc-400 text-sm font-medium">Belum ada catatan transaksi yang tersimpan.</p>
                    <p class="text-zinc-600 text-xs font-mono mt-1">Mulai dengan mencatat pemasukan, pengeluaran, atau mengisi saldo.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="border-b border-white/5 text-[11px] font-mono uppercase tracking-wider text-zinc-500">
                                <th class="pb-3 font-semibold">Tipe</th>
                                <th class="pb-3 font-semibold">Kategori</th>
                                <th class="pb-3 font-semibold">Keterangan</th>
                                <th class="pb-3 font-semibold">Tanggal</th>
                                <th class="pb-3 font-semibold text-right">Nominal</th>
                                <th class="pb-3 font-semibold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach($recentTransactions as $tx)
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
                                    <td class="py-3.5 text-zinc-300 font-medium max-w-xs truncate">
                                        {{ $tx->description ?: '-' }}
                                    </td>
                                    <td class="py-3.5 font-mono text-xs text-zinc-400">
                                        {{ $tx->date->format('d M Y') }}
                                    </td>
                                    <td class="py-3.5 text-right font-mono-numbers font-bold text-sm {{ $tx->type === 'income' ? 'text-emerald-400' : 'text-rose-400' }}">
                                        {{ $tx->type === 'income' ? '+' : '-' }}Rp {{ number_format($tx->amount, 0, ',', '.') }}
                                    </td>
                                    <td class="py-3.5 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('transactions.edit', $tx) }}" class="p-1.5 rounded-lg bg-zinc-800 text-zinc-400 hover:text-white hover:bg-zinc-700 transition" title="Edit Transaksi">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </a>
                                            <form method="POST" action="{{ route('transactions.destroy', $tx) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus catatan transaksi ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-1.5 rounded-lg bg-rose-950/40 text-rose-400 hover:text-white hover:bg-rose-900 transition" title="Hapus Transaksi">
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
            @endif
        </div>
    </div>

    <!-- Chart.js Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('cashflowChart');
            if (!ctx) return;

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($chartMonths) !!},
                    datasets: [
                        {
                            label: 'Pemasukan (Rp)',
                            data: {!! json_encode($chartIncome) !!},
                            backgroundColor: 'rgba(0, 255, 136, 0.75)',
                            borderColor: '#00ff88',
                            borderWidth: 1.5,
                            borderRadius: 6,
                        },
                        {
                            label: 'Pengeluaran (Rp)',
                            data: {!! json_encode($chartExpense) !!},
                            backgroundColor: 'rgba(255, 0, 85, 0.75)',
                            borderColor: '#ff0055',
                            borderWidth: 1.5,
                            borderRadius: 6,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            grid: {
                                color: 'rgba(255, 255, 255, 0.05)',
                            },
                            ticks: {
                                color: '#a1a1aa',
                                font: {
                                    family: "'JetBrains Mono', monospace",
                                    size: 11
                                }
                            }
                        },
                        y: {
                            grid: {
                                color: 'rgba(255, 255, 255, 0.05)',
                            },
                            ticks: {
                                color: '#a1a1aa',
                                font: {
                                    family: "'JetBrains Mono', monospace",
                                    size: 11
                                },
                                callback: function(value) {
                                    return 'Rp ' + (value / 1000).toLocaleString('id-ID') + 'k';
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#0c0e17',
                            borderColor: '#3f3f46',
                            borderWidth: 1,
                            titleFont: {
                                family: "'JetBrains Mono', monospace"
                            },
                            bodyFont: {
                                family: "'JetBrains Mono', monospace"
                            },
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
