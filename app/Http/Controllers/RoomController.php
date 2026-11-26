<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RoomController extends Controller
{
    public function index(): View
    {
        $rooms = Room::withCount('instruments')->latest()->get();

        return view('rooms.index', compact('rooms'));
    }

    public function create(): View
    {
        return view('rooms.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:20', 'unique:rooms,code'],
            'name' => ['required', 'string', 'max:120'],
            'capacity' => ['required', 'integer', 'min:1', 'max:100'],
            'hourly_rate' => ['required', 'integer', 'min:0'],
            'status' => ['required', 'in:available,maintenance'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        Room::create($validated);

        return redirect()->route('rooms.index')->with('success', 'Data ruangan studio berhasil ditambahkan.');
    }

    public function edit(Room $room): View
    {
        return view('rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room): RedirectResponse
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:20', 'unique:rooms,code,' . $room->id],
            'name' => ['required', 'string', 'max:120'],
            'capacity' => ['required', 'integer', 'min:1', 'max:100'],
            'hourly_rate' => ['required', 'integer', 'min:0'],
            'status' => ['required', 'in:available,maintenance'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        $room->update($validated);

        return redirect()->route('rooms.index')->with('success', 'Data ruangan studio berhasil diperbarui.');
    }

    public function destroy(Room $room): RedirectResponse
    {
        $room->delete();

        return redirect()->route('rooms.index')->with('success', 'Data ruangan studio berhasil dihapus.');
    }
}