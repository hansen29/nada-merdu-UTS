<?php

namespace Database\Seeders;

use App\Models\Instrument;
use App\Models\Room;
use Illuminate\Database\Seeder;

class StudioMasterSeeder extends Seeder
{
    public function run(): void
    {
        $studioA = Room::updateOrCreate(
            ['code' => 'RM-01'],
            [
                'name' => 'Studio A - Live Band',
                'capacity' => 8,
                'hourly_rate' => 85000,
                'status' => 'available',
                'description' => 'Ruang latihan utama full set drum, 2 amp gitar, 1 amp bass, dan mixer.',
            ]
        );

        $studioB = Room::updateOrCreate(
            ['code' => 'RM-02'],
            [
                'name' => 'Studio B - Acoustic & Vocal',
                'capacity' => 5,
                'hourly_rate' => 60000,
                'status' => 'available',
                'description' => 'Cocok untuk latihan akustik, vokal, dan pre-production.',
            ]
        );

        Instrument::updateOrCreate(
            ['name' => 'Drum Set Tama Imperialstar'],
            [
                'room_id' => $studioA->id,
                'category' => 'Drum',
                'stock' => 1,
                'rental_rate' => 0,
                'condition' => 'baik',
            ]
        );

        Instrument::updateOrCreate(
            ['name' => 'Fender Player Stratocaster'],
            [
                'room_id' => $studioB->id,
                'category' => 'Gitar',
                'stock' => 2,
                'rental_rate' => 20000,
                'condition' => 'baik',
            ]
        );
    }
}