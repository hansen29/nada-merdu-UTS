@extends('layouts.app')

@section('title', 'Tambah Ruangan Studio')

@section('content')
<div class="max-w-2xl">
    <h1 class="text-2xl font-bold mb-1">Tambah Ruangan Studio</h1>
    <p class="text-sm text-slate-400 mb-6">Isi detail ruangan baru untuk Studio Musik Nada Merdu.</p>

    <form action="{{ route('rooms.store') }}" method="POST" class="bg-slate-900 border border-slate-800 rounded-xl p-6 space-y-4">
        @csrf

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm mb-1">Kode Ruangan</label>
                <input type="text" name="code" value="{{ old('code') }}" placeholder="RM-04" required
                       class="w-full rounded-lg bg-slate-800 border border-slate-700 px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm mb-1">Status</label>
                <select name="status" class="w-full rounded-lg bg-slate-800 border border-slate-700 px-3 py-2 text-sm">
                    <option value="available" @selected(old('status', 'available') === 'available')>Tersedia</option>
                    <option value="maintenance" @selected(old('status') === 'maintenance')>Perawatan</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-sm mb-1">Nama Ruangan</label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="Studio D - Podcast & Vocal" required
                   class="w-full rounded-lg bg-slate-800 border border-slate-700 px-3 py-2 text-sm">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm mb-1">Kapasitas (Orang)</label>
                <input type="number" name="capacity" value="{{ old('capacity', 6) }}" min="1" required
                       class="w-full rounded-lg bg-slate-800 border border-slate-700 px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm mb-1">Tarif per Jam (Rp)</label>
                <input type="number" name="hourly_rate" value="{{ old('hourly_rate', 75000) }}" min="0" required
                       class="w-full rounded-lg bg-slate-800 border border-slate-700 px-3 py-2 text-sm">
            </div>
        </div>

        <div>
            <label class="block text-sm mb-1">Deskripsi / Fasilitas</label>
            <textarea name="description" rows="3" placeholder="Contoh: Drum kit, mixer digital, mic kondensor"
                      class="w-full rounded-lg bg-slate-800 border border-slate-700 px-3 py-2 text-sm">{{ old('description') }}</textarea>
        </div>

        <div class="flex items-center justify-end gap-3 pt-2">
            <a href="{{ route('rooms.index') }}" class="px-4 py-2 rounded-lg bg-slate-800 hover:bg-slate-700 text-sm">Batal</a>
            <button type="submit" class="px-4 py-2 rounded-lg bg-amber-500 text-slate-950 font-semibold text-sm hover:bg-amber-400">
                Simpan Ruangan
            </button>
        </div>
    </form>
</div>
@endsection