<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        $roomA = Room::where('code', 'RM-01')->first();
        $roomB = Room::where('code', 'RM-02')->first();

        if ($roomA) {
            Booking::updateOrCreate(
                ['booking_code' => 'BK-001'],
                [
                    'room_id' => $roomA->id,
                    'customer_name' => 'Senja Indie Band',
                    'phone' => '081234567890',
                    'booking_date' => now()->toDateString(),
                    'start_time' => '15:00',
                    'duration_hours' => 2,
                    'total_price' => $roomA->hourly_rate * 2,
                    'status' => 'confirmed',
                    'notes' => 'Latihan materi EP baru.',
                ]
            );
        }

        if ($roomB) {
            Booking::updateOrCreate(
                ['booking_code' => 'BK-002'],
                [
                    'room_id' => $roomB->id,
                    'customer_name' => 'Raka Acoustic Duo',
                    'phone' => '085678901234',
                    'booking_date' => now()->addDay()->toDateString(),
                    'start_time' => '19:00',
                    'duration_hours' => 3,
                    'total_price' => $roomB->hourly_rate * 3,
                    'status' => 'pending',
                    'notes' => 'Butuh 2 mic vokal tambahan.',
                ]
            );
        }
    }
}