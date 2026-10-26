<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 text-xs font-mono tracking-widest text-rose-400 uppercase">
                    <span class="inline-block w-2 h-2 rounded-full bg-rose-500 animate-pulse"></span>
                    <span>PANEL KENDALI SISTEM // ROLE: ADMIN</span>
                </div>
                <h2 class="font-graffiti text-2xl sm:text-3xl text-white tracking-wide mt-1">
                    Manajemen <span class="text-transparent bg-clip-text bg-gradient-to-r from-rose-400 via-purple-400 to-amber-300">Pengguna & Hak Akses</span>
                </h2>
            </div>
            <span class="text-xs font-mono px-3 py-1.5 rounded-full bg-rose-950/60 border border-rose-500/40 text-rose-300 font-bold uppercase tracking-wider graffiti-glow-red">
                ADMIN ACCESS ONLY
            </span>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        <!-- Admin Overview Stat Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="graffiti-card p-5 rounded-2xl border border-white/10">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-[11px] font-mono uppercase text-zinc-400 font-bold">Total Pengguna Terdaftar</div>
                        <div class="text-3xl font-bold font-mono-numbers text-white mt-1">{{ $totalUsers }}</div>
                    </div>
                    <div class="p-3 rounded-xl bg-purple-500/10 text-purple-400 border border-purple-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                </div>
            </div>

            <div class="graffiti-card p-5 rounded-2xl border border-emerald-500/20">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-[11px] font-mono uppercase text-emerald-400 font-bold">Akun Aktif</div>
                        <div class="text-3xl font-bold font-mono-numbers text-emerald-400 mt-1">{{ $activeUsers }}</div>
                    </div>
                    <div class="p-3 rounded-xl bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
            </div>

            <div class="graffiti-card p-5 rounded-2xl border border-rose-500/20">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-[11px] font-mono uppercase text-rose-400 font-bold">Akun Dinonaktifkan</div>
                        <div class="text-3xl font-bold font-mono-numbers text-rose-400 mt-1">{{ $inactiveUsers }}</div>
                    </div>
                    <div class="p-3 rounded-xl bg-rose-500/10 text-rose-400 border border-rose-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter & Search -->
        <div class="graffiti-card p-5 rounded-2xl border border-white/10">
            <form method="GET" action="{{ route('admin.users.index') }}" class="grid grid-cols-1 sm:grid-cols-3 gap-3 items-end">
                <div>
                    <label class="block text-[11px] font-mono uppercase tracking-wider text-zinc-400 mb-1">Cari Nama / Email</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Ketik kata kunci..." class="w-full px-3.5 py-2 rounded-xl bg-zinc-900 border border-zinc-700 text-sm text-zinc-200 font-mono focus:border-rose-500 focus:ring-1 focus:ring-rose-500">
                </div>

                <div>
                    <label class="block text-[11px] font-mono uppercase tracking-wider text-zinc-400 mb-1">Status Akun</label>
                    <select name="status" class="w-full px-3.5 py-2 rounded-xl bg-zinc-900 border border-zinc-700 text-sm text-zinc-200 font-mono focus:border-rose-500 focus:ring-1 focus:ring-rose-500">
                        <option value="">Semua Status</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Hanya Aktif</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Hanya Nonaktif</option>
                    </select>
                </div>

                <div class="flex items-center gap-2">
                    <button type="submit" class="flex-1 px-4 py-2 rounded-xl bg-rose-500 text-white font-bold text-xs uppercase tracking-wider hover:bg-rose-600 transition graffiti-glow-red">
                        Filter User
                    </button>
                    @if(request()->hasAny(['search', 'status']))
                        <a href="{{ route('admin.users.index') }}" class="px-3 py-2 rounded-xl bg-zinc-800 text-zinc-400 hover:text-white text-xs font-mono uppercase tracking-wider">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Users Table -->
        <div class="graffiti-card p-6 rounded-2xl border border-white/10">
            <div class="flex items-center justify-between pb-4 border-b border-white/10 mb-4">
                <div>
                    <h3 class="font-display font-bold text-lg text-white">Daftar Akun Pengguna Terdaftar</h3>
                    <p class="text-xs font-mono text-zinc-400 mt-0.5">Kelola status aktif akun atau hapus akun pengguna</p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b border-white/5 text-[11px] font-mono uppercase tracking-wider text-zinc-500">
                            <th class="pb-3.5 font-semibold">Pengguna</th>
                            <th class="pb-3.5 font-semibold">Role Spatie</th>
                            <th class="pb-3.5 font-semibold">Status Akun</th>
                            <th class="pb-3.5 font-semibold">Saldo Terhitung</th>
                            <th class="pb-3.5 font-semibold">Total Tx</th>
                            <th class="pb-3.5 font-semibold">Bergabung</th>
                            <th class="pb-3.5 font-semibold text-right">Aksi Manajemen</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach($users as $user)
                            <tr class="hover:bg-white/[0.02] transition {{ ! $user->is_active ? 'opacity-60 bg-rose-950/10' : '' }}">
                                <td class="py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-xl bg-zinc-800 border border-zinc-700 flex items-center justify-center font-mono font-bold text-xs {{ $user->hasRole('admin') ? 'text-rose-400' : 'text-emerald-400' }}">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="font-bold text-white text-sm flex items-center gap-1.5">
                                                <span>{{ $user->name }}</span>
                                                @if($user->id === Auth::id())
                                                    <span class="text-[9px] font-mono px-1.5 py-0.5 rounded bg-zinc-800 text-zinc-400 border border-zinc-700">(Anda)</span>
                                                @endif
                                            </div>
                                            <div class="text-xs text-zinc-400 font-mono">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>

                                <td class="py-4">
                                    @foreach($user->roles as $role)
                                        <span class="px-2.5 py-1 rounded-md text-[10px] font-mono font-bold uppercase tracking-wider {{ $role->name === 'admin' ? 'bg-rose-500/20 text-rose-300 border border-rose-500/40' : 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/40' }}">
                                            {{ $role->name }}
                                        </span>
                                    @endforeach
                                </td>

                                <td class="py-4">
                                    @if($user->is_active)
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-mono font-bold uppercase tracking-wider bg-emerald-500/15 text-emerald-400 border border-emerald-500/30">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                            Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-mono font-bold uppercase tracking-wider bg-rose-500/15 text-rose-400 border border-rose-500/30">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-400"></span>
                                            Nonaktif
                                        </span>
                                    @endif
                                </td>

                                <td class="py-4 font-mono-numbers text-xs font-bold {{ $user->currentBalance() >= 0 ? 'text-zinc-200' : 'text-rose-400' }}">
                                    Rp {{ number_format($user->currentBalance(), 0, ',', '.') }}
                                </td>

                                <td class="py-4 font-mono text-xs text-zinc-400">
                                    {{ $user->transactions_count }} catatan
                                </td>

                                <td class="py-4 font-mono text-xs text-zinc-500">
                                    {{ $user->created_at->format('d M Y') }}
                                </td>

                                <td class="py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <!-- Lihat Transaksi Keuangan User -->
                                        <a href="{{ route('admin.users.transactions', $user) }}" class="p-2 rounded-xl bg-zinc-800 text-zinc-300 hover:text-white hover:bg-zinc-700 transition" title="Lihat Audit Transaksi User">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        </a>

                                        @if($user->id !== Auth::id())
                                            <!-- Toggle Status Aktif / Nonaktif -->
                                            <form method="POST" action="{{ route('admin.users.toggle', $user) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="p-2 rounded-xl text-xs font-mono font-bold transition {{ $user->is_active ? 'bg-amber-500/20 text-amber-300 hover:bg-amber-500/30 border border-amber-500/40' : 'bg-emerald-500/20 text-emerald-300 hover:bg-emerald-500/30 border border-emerald-500/40' }}" title="{{ $user->is_active ? 'Nonaktifkan Akun User' : 'Aktifkan Akun User' }}">
                                                    @if($user->is_active)
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                                                    @else
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                    @endif
                                                </button>
                                            </form>

                                            <!-- Hapus User -->
                                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Apakah Anda yakin ingin MENGHAPUS PERMANEN akun user ini beserta seluruh data keuangannya?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 rounded-xl bg-rose-950/40 text-rose-400 hover:text-white hover:bg-rose-900 border border-rose-900/50 transition" title="Hapus User">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6 pt-4 border-t border-white/5">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

