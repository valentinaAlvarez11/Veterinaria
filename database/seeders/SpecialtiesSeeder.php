<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialtiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('specialties')->insert([
            'name' => 'Medicina General',
            'description' => 'Atención general para mascotas.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('specialties')->insert([
            'name' => 'Cirugía',
            'description' => 'Procedimientos quirúrgicos especializados para mascotas.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('specialties')->insert([
            'name' => 'Vacunación',
            'description' => 'Aplicación de vacunas preventivas.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
