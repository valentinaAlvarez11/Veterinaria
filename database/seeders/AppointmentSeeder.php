<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Appointment::create([
            'client_id' => $client->id,
            'veterinarian_id' => $veterinarian->id,
            'appointment_date' => now()->addDays(1),
            'reason' => 'Chequeo general',
            'notes' => 'Nada de importancia',
        ]);
    }
}
