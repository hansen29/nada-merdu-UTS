@extends('layouts.app')

@section('title', 'Edit Alat Musik')

@section('content')
<div class="max-w-2xl">
    <h1 class="text-2xl font-bold mb-1">Edit Alat Musik</h1>
    <p class="text-sm text-slate-400 mb-6">Perbarui data instrumen {{ $instrument->name }}.</p>

    <form action="{{ route('instruments.update', $instrument) }}" method="POST" class="bg-slate-900 border border-slate-800 rounded-xl p-6 space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm mb-1">Nama Alat Musik</label>
            <input type="text" name="name" value="{{ old('name', $instrument->name) }}" required
                   class="w-full rounded-lg bg-slate-800 border border-slate-700 px-3 py-2 text-sm">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm mb-1">Kategori</label>
                <input type="text" name="category" value="{{ old('category', $instrument->category) }}" required
                       class="w-full rounded-lg bg-slate-800 border border-slate-700 px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm mb-1">Penempatan Ruangan (Opsional)</label>
                <select name="room_id" class="w-full rounded-lg bg-slate-800 border border-slate-700 px-3 py-2 text-sm">
                    <option value="">-- Inventaris Umum --</option>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}" @selected(old('room_id', $instrument->room_id) == $room->id)>{{ $room->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm mb-1">Stok (Unit)</label>
                <input type="number" name="stock" value="{{ old('stock', $instrument->stock) }}" min="0" required
                       class="w-full rounded-lg bg-slate-800 border border-slate-700 px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm mb-1">Tarif Sewa / Jam (Rp)</label>
                <input type="number" name="rental_rate" value="{{ old('rental_rate', $instrument->rental_rate) }}" min="0" required
                       class="w-full rounded-lg bg-slate-800 border border-slate-700 px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm mb-1">Kondisi</label>
                <select name="condition" class="w-full rounded-lg bg-slate-800 border border-slate-700 px-3 py-2 text-sm">
                    <option value="baik" @selected(old('condition', $instrument->condition) === 'baik')>Baik</option>
                    <option value="perlu_cek" @selected(old('condition') === 'perlu_cek')>Perlu Cek</option>
                </select>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3 pt-2">
            <a href="{{ route('instruments.index') }}" class="px-4 py-2 rounded-lg bg-slate-800 hover:bg-slate-700 text-sm">Batal</a>
            <button type="submit" class="px-4 py-2 rounded-lg bg-amber-500 text-slate-950 font-semibold text-sm hover:bg-amber-400">
                Update Alat Musik
            </button>
        </div>
    </form>
</div>
@endsection