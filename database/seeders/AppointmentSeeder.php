<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('appointments')->insert([
            [
                'client_id' => 1,
                'veterinarian_id' => 1,
                'appointment_date' => Carbon::parse('2024-11-29 03:09:10'),
                'reason' => 'Consulta general',
                'status' => 'pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'client_id' => 2,
                'veterinarian_id' => 2,
                'appointment_date' => Carbon::parse('2024-11-30 10:00:00'),
                'reason' => 'Chequeo preventivo',
                'status' => 'accepted',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
