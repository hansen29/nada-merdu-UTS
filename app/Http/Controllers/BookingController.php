<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function index(Request $request): View
    {
        $query = Booking::with('room')->latest('booking_date')->latest('id');

        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }

        $bookings = $query->get();

        $summary = [
            'total_bookings' => Booking::count(),
            'confirmed_count' => Booking::whereIn('status', ['confirmed', 'completed'])->count(),
            'total_revenue' => Booking::whereIn('status', ['confirmed', 'completed'])->sum('total_price'),
        ];

        return view('bookings.index', compact('bookings', 'summary'));
    }

    public function create(): View
    {
        $rooms = Room::where('status', 'available')->orderBy('name')->get();

        return view('bookings.create', compact('rooms'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'booking_code' => ['required', 'string', 'max:30', 'unique:bookings,booking_code'],
            'room_id' => ['required', 'exists:rooms,id'],
            'customer_name' => ['required', 'string', 'max:120'],
            'phone' => ['required', 'string', 'max:30'],
            'booking_date' => ['required', 'date'],
            'start_time' => ['required', 'string', 'max:10'],
            'duration_hours' => ['required', 'integer', 'min:1', 'max:24'],
            'status' => ['required', 'in:pending,confirmed,completed,cancelled'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $room = Room::findOrFail($validated['room_id']);
        $validated['total_price'] = $room->hourly_rate * $validated['duration_hours'];

        Booking::create($validated);

        return redirect()->route('bookings.index')->with('success', 'Data booking studio berhasil ditambahkan.');
    }

    public function edit(Booking $booking): View
    {
        $rooms = Room::orderBy('name')->get();

        return view('bookings.edit', compact('booking', 'rooms'));
    }

    public function update(Request $request, Booking $booking): RedirectResponse
    {
        $validated = $request->validate([
            'booking_code' => ['required', 'string', 'max:30', 'unique:bookings,booking_code,' . $booking->id],
            'room_id' => ['required', 'exists:rooms,id'],
            'customer_name' => ['required', 'string', 'max:120'],
            'phone' => ['required', 'string', 'max:30'],
            'booking_date' => ['required', 'date'],
            'start_time' => ['required', 'string', 'max:10'],
            'duration_hours' => ['required', 'integer', 'min:1', 'max:24'],
            'status' => ['required', 'in:pending,confirmed,completed,cancelled'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $room = Room::findOrFail($validated['room_id']);
        $validated['total_price'] = $room->hourly_rate * $validated['duration_hours'];

        $booking->update($validated);

        return redirect()->route('bookings.index')->with('success', 'Data booking studio berhasil diperbarui.');
    }

    public function destroy(Booking $booking): RedirectResponse
    {
        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'Data booking studio berhasil dihapus.');
    }
}