@extends('layouts.app')

@section('title', 'Booking Studio')

@section('content')
<div class="flex flex-wrap items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold">Booking & Penyewaan Studio</h1>
        <p class="text-sm text-slate-400">Kelola jadwal sewa ruangan, durasi, status booking, dan estimasi pendapatan.</p>
    </div>
    <a href="{{ route('bookings.create') }}" class="px-4 py-2 rounded-lg bg-amber-500 text-slate-950 font-semibold text-sm hover:bg-amber-400">
        + Buat Booking
    </a>
</div>

<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
    <div class="bg-slate-900 border border-slate-800 rounded-xl p-4">
        <p class="text-xs text-slate-400 uppercase">Total Booking</p>
        <p class="text-2xl font-bold mt-1">{{ $summary['total_bookings'] }}</p>
    </div>
    <div class="bg-slate-900 border border-slate-800 rounded-xl p-4">
        <p class="text-xs text-slate-400 uppercase">Booking Aktif / Selesai</p>
        <p class="text-2xl font-bold text-emerald-400 mt-1">{{ $summary['confirmed_count'] }}</p>
    </div>
    <div class="bg-slate-900 border border-slate-800 rounded-xl p-4">
        <p class="text-xs text-slate-400 uppercase">Pendapatan Tercatat</p>
        <p class="text-2xl font-bold text-amber-400 mt-1">Rp {{ number_format($summary['total_revenue'], 0, ',', '.') }}</p>
    </div>
</div>

<div class="mb-4 flex flex-wrap items-center gap-2 text-xs">
    <a href="{{ route('bookings.index') }}" class="px-3 py-1.5 rounded-lg {{ !request('status') ? 'bg-amber-500 text-slate-950 font-semibold' : 'bg-slate-800 text-slate-300' }}">Semua</a>
    <a href="{{ route('bookings.index', ['status' => 'pending']) }}" class="px-3 py-1.5 rounded-lg {{ request('status') === 'pending' ? 'bg-amber-500 text-slate-950 font-semibold' : 'bg-slate-800 text-slate-300' }}">Pending</a>
    <a href="{{ route('bookings.index', ['status' => 'confirmed']) }}" class="px-3 py-1.5 rounded-lg {{ request('status') === 'confirmed' ? 'bg-amber-500 text-slate-950 font-semibold' : 'bg-slate-800 text-slate-300' }}">Confirmed</a>
    <a href="{{ route('bookings.index', ['status' => 'completed']) }}" class="px-3 py-1.5 rounded-lg {{ request('status') === 'completed' ? 'bg-amber-500 text-slate-950 font-semibold' : 'bg-slate-800 text-slate-300' }}">Completed</a>
    <a href="{{ route('bookings.index', ['status' => 'cancelled']) }}" class="px-3 py-1.5 rounded-lg {{ request('status') === 'cancelled' ? 'bg-amber-500 text-slate-950 font-semibold' : 'bg-slate-800 text-slate-300' }}">Cancelled</a>
</div>

<div class="overflow-x-auto bg-slate-900 border border-slate-800 rounded-xl">
    <table class="w-full text-left text-sm">
        <thead class="bg-slate-800/80 text-slate-300 uppercase text-xs">
            <tr>
                <th class="px-4 py-3">Kode</th>
                <th class="px-4 py-3">Penyewa / Band</th>
                <th class="px-4 py-3">Ruangan</th>
                <th class="px-4 py-3">Jadwal</th>
                <th class="px-4 py-3">Total</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-800">
            @forelse ($bookings as $booking)
                <tr class="hover:bg-slate-800/40">
                    <td class="px-4 py-3 font-mono text-amber-400">{{ $booking->booking_code }}</td>
                    <td class="px-4 py-3">
                        <div class="font-semibold text-white">{{ $booking->customer_name }}</div>
                        <div class="text-xs text-slate-400">{{ $booking->phone }}</div>
                        @if ($booking->notes)
                            <div class="text-xs text-slate-400 italic mt-0.5">{{ $booking->notes }}</div>
                        @endif
                    </td>
                    <td class="px-4 py-3">{{ $booking->room?->name ?? '-' }}</td>
                    <td class="px-4 py-3">
                        <div>{{ $booking->booking_date->format('d M Y') }}</div>
                        <div class="text-xs text-slate-400">{{ $booking->start_time }} ({{ $booking->duration_hours }} jam)</div>
                    </td>
                    <td class="px-4 py-3 font-semibold">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                    <td class="px-4 py-3">
                        <span class="px-2.5 py-1 rounded-full text-xs bg-slate-800 text-amber-300 border border-slate-700 capitalize">
                            {{ $booking->status }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-right space-x-2">
                        <a href="{{ route('bookings.edit', $booking) }}" class="inline-block px-3 py-1.5 rounded bg-slate-800 hover:bg-slate-700 text-xs">
                            Edit
                        </a>
                        <form action="{{ route('bookings.destroy', $booking) }}" method="POST" class="inline" onsubmit="return confirm('Hapus data booking ini?')">
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
                    <td colspan="7" class="px-4 py-8 text-center text-slate-400">Belum ada data booking studio.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection