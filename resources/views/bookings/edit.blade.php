@extends('layouts.app')

@section('title', 'Edit Booking Studio')

@section('content')
<div class="max-w-2xl">
    <h1 class="text-2xl font-bold mb-1">Edit Booking Studio</h1>
    <p class="text-sm text-slate-400 mb-6">Perbarui booking {{ $booking->booking_code }}.</p>

    <form action="{{ route('bookings.update', $booking) }}" method="POST" class="bg-slate-900 border border-slate-800 rounded-xl p-6 space-y-4">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm mb-1">Kode Booking</label>
                <input type="text" name="booking_code" value="{{ old('booking_code', $booking->booking_code) }}" required
                       class="w-full rounded-lg bg-slate-800 border border-slate-700 px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm mb-1">Ruangan Studio</label>
                <select name="room_id" required class="w-full rounded-lg bg-slate-800 border border-slate-700 px-3 py-2 text-sm">
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}" @selected(old('room_id', $booking->room_id) == $room->id)>
                            {{ $room->name }} (Rp {{ number_format($room->hourly_rate, 0, ',', '.') }}/jam)
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm mb-1">Nama Penyewa / Band</label>
                <input type="text" name="customer_name" value="{{ old('customer_name', $booking->customer_name) }}" required
                       class="w-full rounded-lg bg-slate-800 border border-slate-700 px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm mb-1">No. Telepon / WA</label>
                <input type="text" name="phone" value="{{ old('phone', $booking->phone) }}" required
                       class="w-full rounded-lg bg-slate-800 border border-slate-700 px-3 py-2 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm mb-1">Tanggal</label>
                <input type="date" name="booking_date" value="{{ old('booking_date', $booking->booking_date->format('Y-m-d')) }}" required
                       class="w-full rounded-lg bg-slate-800 border border-slate-700 px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm mb-1">Jam Mulai</label>
                <input type="text" name="start_time" value="{{ old('start_time', $booking->start_time) }}" required
                       class="w-full rounded-lg bg-slate-800 border border-slate-700 px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm mb-1">Durasi (Jam)</label>
                <input type="number" name="duration_hours" value="{{ old('duration_hours', $booking->duration_hours) }}" min="1" max="24" required
                       class="w-full rounded-lg bg-slate-800 border border-slate-700 px-3 py-2 text-sm">
            </div>
        </div>

        <div>
            <label class="block text-sm mb-1">Status Booking</label>
            <select name="status" class="w-full rounded-lg bg-slate-800 border border-slate-700 px-3 py-2 text-sm">
                <option value="pending" @selected(old('status', $booking->status) === 'pending')>Pending</option>
                <option value="confirmed" @selected(old('status', $booking->status) === 'confirmed')>Confirmed</option>
                <option value="completed" @selected(old('status', $booking->status) === 'completed')>Completed</option>
                <option value="cancelled" @selected(old('status', $booking->status) === 'cancelled')>Cancelled</option>
            </select>
        </div>

        <div>
            <label class="block text-sm mb-1">Catatan</label>
            <textarea name="notes" rows="3" class="w-full rounded-lg bg-slate-800 border border-slate-700 px-3 py-2 text-sm">{{ old('notes', $booking->notes) }}</textarea>
        </div>

        <div class="flex items-center justify-end gap-3 pt-2">
            <a href="{{ route('bookings.index') }}" class="px-4 py-2 rounded-lg bg-slate-800 hover:bg-slate-700 text-sm">Batal</a>
            <button type="submit" class="px-4 py-2 rounded-lg bg-amber-500 text-slate-950 font-semibold text-sm hover:bg-amber-400">
                Update Booking
            </button>
        </div>
    </form>
</div>
@endsection