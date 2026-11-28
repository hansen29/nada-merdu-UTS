@extends('layouts.app')

@section('title', 'Data Ruangan Studio')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-bold">Data Ruangan Studio</h1>
        <p class="text-sm text-slate-400">Kelola daftar ruangan latihan/recording, kapasitas, dan tarif per jam.</p>
    </div>
    <a href="{{ route('rooms.create') }}" class="px-4 py-2 rounded-lg bg-amber-500 text-slate-950 font-semibold text-sm hover:bg-amber-400">
        + Tambah Ruangan
    </a>
</div>

<div class="overflow-x-auto bg-slate-900 border border-slate-800 rounded-xl">
    <table class="w-full text-left text-sm">
        <thead class="bg-slate-800/80 text-slate-300 uppercase text-xs">
            <tr>
                <th class="px-4 py-3">Kode</th>
                <th class="px-4 py-3">Nama Ruangan</th>
                <th class="px-4 py-3">Kapasitas</th>
                <th class="px-4 py-3">Tarif / Jam</th>
                <th class="px-4 py-3">Alat Terpasang</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-800">
            @forelse ($rooms as $room)
                <tr class="hover:bg-slate-800/40">
                    <td class="px-4 py-3 font-mono text-amber-400">{{ $room->code }}</td>
                    <td class="px-4 py-3">
                        <div class="font-semibold text-white">{{ $room->name }}</div>
                        @if ($room->description)
                            <div class="text-xs text-slate-400">{{ $room->description }}</div>
                        @endif
                    </td>
                    <td class="px-4 py-3">{{ $room->capacity }} orang</td>
                    <td class="px-4 py-3">Rp {{ number_format($room->hourly_rate, 0, ',', '.') }}</td>
                    <td class="px-4 py-3">{{ $room->instruments_count }} jenis</td>
                    <td class="px-4 py-3">
                        @if ($room->status === 'available')
                            <span class="px-2.5 py-1 rounded-full text-xs bg-emerald-950 text-emerald-300 border border-emerald-700">
                                Tersedia
                            </span>
                        @else
                            <span class="px-2.5 py-1 rounded-full text-xs bg-amber-950 text-amber-300 border border-amber-700">
                                Perawatan
                            </span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-right space-x-2">
                        <a href="{{ route('rooms.edit', $room) }}" class="inline-block px-3 py-1.5 rounded bg-slate-800 hover:bg-slate-700 text-xs">
                            Edit
                        </a>
                        <form action="{{ route('rooms.destroy', $room) }}" method="POST" class="inline" onsubmit="return confirm('Hapus ruangan ini?')">
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
                    <td colspan="7" class="px-4 py-8 text-center text-slate-400">Belum ada data ruangan studio.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection