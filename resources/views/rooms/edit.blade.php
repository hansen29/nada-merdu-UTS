@extends('layouts.app')

@section('title', 'Edit Ruangan Studio')

@section('content')
<div class="max-w-2xl">
    <h1 class="text-2xl font-bold mb-1">Edit Ruangan Studio</h1>
    <p class="text-sm text-slate-400 mb-6">Perbarui informasi ruangan {{ $room->name }}.</p>

    <form action="{{ route('rooms.update', $room) }}" method="POST" class="bg-slate-900 border border-slate-800 rounded-xl p-6 space-y-4">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm mb-1">Kode Ruangan</label>
                <input type="text" name="code" value="{{ old('code', $room->code) }}" required
                       class="w-full rounded-lg bg-slate-800 border border-slate-700 px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm mb-1">Status</label>
                <select name="status" class="w-full rounded-lg bg-slate-800 border border-slate-700 px-3 py-2 text-sm">
                    <option value="available" @selected(old('status', $room->status) === 'available')>Tersedia</option>
                    <option value="maintenance" @selected(old('status', $room->status) === 'maintenance')>Perawatan</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-sm mb-1">Nama Ruangan</label>
            <input type="text" name="name" value="{{ old('name', $room->name) }}" required
                   class="w-full rounded-lg bg-slate-800 border border-slate-700 px-3 py-2 text-sm">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm mb-1">Kapasitas (Orang)</label>
                <input type="number" name="capacity" value="{{ old('capacity', $room->capacity) }}" min="1" required
                       class="w-full rounded-lg bg-slate-800 border border-slate-700 px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm mb-1">Tarif per Jam (Rp)</label>
                <input type="number" name="hourly_rate" value="{{ old('hourly_rate', $room->hourly_rate) }}" min="0" required
                       class="w-full rounded-lg bg-slate-800 border border-slate-700 px-3 py-2 text-sm">
            </div>
        </div>

        <div>
            <label class="block text-sm mb-1">Deskripsi / Fasilitas</label>
            <textarea name="description" rows="3"
                      class="w-full rounded-lg bg-slate-800 border border-slate-700 px-3 py-2 text-sm">{{ old('description', $room->description) }}</textarea>
        </div>

        <div class="flex items-center justify-end gap-3 pt-2">
            <a href="{{ route('rooms.index') }}" class="px-4 py-2 rounded-lg bg-slate-800 hover:bg-slate-700 text-sm">Batal</a>
            <button type="submit" class="px-4 py-2 rounded-lg bg-amber-500 text-slate-950 font-semibold text-sm hover:bg-amber-400">
                Update Ruangan
            </button>
        </div>
    </form>
</div>
@endsection