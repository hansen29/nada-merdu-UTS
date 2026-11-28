<?php

namespace App\Http\Controllers;

use App\Models\Instrument;
use App\Models\Room;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InstrumentController extends Controller
{
    public function index(): View
    {
        $instruments = Instrument::with('room')->latest()->get();

        return view('instruments.index', compact('instruments'));
    }

    public function create(): View
    {
        $rooms = Room::orderBy('name')->get();

        return view('instruments.create', compact('rooms'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'room_id' => ['nullable', 'exists:rooms,id'],
            'name' => ['required', 'string', 'max:120'],
            'category' => ['required', 'string', 'max:60'],
            'stock' => ['required', 'integer', 'min:0', 'max:500'],
            'rental_rate' => ['required', 'integer', 'min:0'],
            'condition' => ['required', 'in:baik,perlu_cek'],
        ]);

        Instrument::create($validated);

        return redirect()->route('instruments.index')->with('success', 'Data alat musik berhasil ditambahkan.');
    }

    public function edit(Instrument $instrument): View
    {
        $rooms = Room::orderBy('name')->get();

        return view('instruments.edit', compact('instrument', 'rooms'));
    }

    public function update(Request $request, Instrument $instrument): RedirectResponse
    {
        $validated = $request->validate([
            'room_id' => ['nullable', 'exists:rooms,id'],
            'name' => ['required', 'string', 'max:120'],
            'category' => ['required', 'string', 'max:60'],
            'stock' => ['required', 'integer', 'min:0', 'max:500'],
            'rental_rate' => ['required', 'integer', 'min:0'],
            'condition' => ['required', 'in:baik,perlu_cek'],
        ]);

        $instrument->update($validated);

        return redirect()->route('instruments.index')->with('success', 'Data alat musik berhasil diperbarui.');
    }

    public function destroy(Instrument $instrument): RedirectResponse
    {
        $instrument->delete();

        return redirect()->route('instruments.index')->with('success', 'Data alat musik berhasil dihapus.');
    }
}