<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AvailabilitySeeder extends Seeder
{
    public function run()
    {
        DB::table('availabilities')->insert([
            [
                'veterinarian_id' => 1,
                'day_of_week' => 'Lunes',
                'start_time' => '09:00:00',
                'end_time' => '13:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'veterinarian_id' => 1,
                'day_of_week' => 'Miercoles',
                'start_time' => '14:00:00',
                'end_time' => '18:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'veterinarian_id' => 2,
                'day_of_week' => 'Viernes',
                'start_time' => '10:00:00',
                'end_time' => '15:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
