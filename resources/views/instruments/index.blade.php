@extends('layouts.app')

@section('title', 'Data Alat Musik')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-bold">Data Alat Musik & Inventaris</h1>
        <p class="text-sm text-slate-400">Kelola stok instrumen, penempatan ruangan, kondisi, dan tarif sewa tambahan.</p>
    </div>
    <a href="{{ route('instruments.create') }}" class="px-4 py-2 rounded-lg bg-amber-500 text-slate-950 font-semibold text-sm hover:bg-amber-400">
        + Tambah Alat Musik
    </a>
</div>

<div class="overflow-x-auto bg-slate-900 border border-slate-800 rounded-xl">
    <table class="w-full text-left text-sm">
        <thead class="bg-slate-800/80 text-slate-300 uppercase text-xs">
            <tr>
                <th class="px-4 py-3">Nama Alat</th>
                <th class="px-4 py-3">Kategori</th>
                <th class="px-4 py-3">Ruangan</th>
                <th class="px-4 py-3">Stok</th>
                <th class="px-4 py-3">Tarif Sewa / Jam</th>
                <th class="px-4 py-3">Kondisi</th>
                <th class="px-4 py-3 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-800">
            @forelse ($instruments as $instrument)
                <tr class="hover:bg-slate-800/40">
                    <td class="px-4 py-3 font-semibold text-white">{{ $instrument->name }}</td>
                    <td class="px-4 py-3">{{ $instrument->category }}</td>
                    <td class="px-4 py-3 text-slate-300">{{ $instrument->room?->name ?? 'Inventaris Umum' }}</td>
                    <td class="px-4 py-3">{{ $instrument->stock }} unit</td>
                    <td class="px-4 py-3">
                        @if ($instrument->rental_rate === 0)
                            <span class="text-emerald-400">Termasuk Paket</span>
                        @else
                            Rp {{ number_format($instrument->rental_rate, 0, ',', '.') }}
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        @if ($instrument->condition === 'baik')
                            <span class="px-2.5 py-1 rounded-full text-xs bg-emerald-950 text-emerald-300 border border-emerald-700">
                                Baik
                            </span>
                        @else
                            <span class="px-2.5 py-1 rounded-full text-xs bg-amber-950 text-amber-300 border border-amber-700">
                                Perlu Cek
                            </span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-right space-x-2">
                        <a href="{{ route('instruments.edit', $instrument) }}" class="inline-block px-3 py-1.5 rounded bg-slate-800 hover:bg-slate-700 text-xs">
                            Edit
                        </a>
                        <form action="{{ route('instruments.destroy', $instrument) }}" method="POST" class="inline" onsubmit="return confirm('Hapus alat musik ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1.5 rounded bg-rose-900/70 hover:bg-rose-800 text-rose-200 text-xs">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-4 py-8 text-center text-slate-400">Belum ada data alat musik.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection