<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VeterinariansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('veterinarians')->insert([
            'name' => 'Dr. Ana Gómez',
            'specialty' => 'Cirugía',
            'email' => 'ana.gomez@gmail.com',
            'phone' => '123456789',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('veterinarians')->insert([
            'name' => 'Dr. Carlos Pérez',
            'specialty' => 'Dermatología',
            'email' => 'carlos.perez@egmail.com',
            'phone' => '987654321',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('veterinarians')->insert([
            'name' => 'Dr. María López',
            'specialty' => 'Oftalmología',
            'email' => 'maria.lopez@gmail.com',
            'phone' => '456123789',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('veterinarians')->insert([
            'name' => 'Dr. Jorge Ramírez',
            'specialty' => 'Cardiología',
            'email' => 'jorge.ramirez@gmail.com',
            'phone' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
