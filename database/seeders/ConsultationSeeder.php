<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConsultationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('consultations')->insert([
            [
                'pet_id' => 1,
                'veterinarian_id' => 1,
                'diagnosis' => 'Infección de oído',
                'treatment' => 'Antibióticos durante 7 días',
                'notes' => 'Revisar en una semana',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'pet_id' => 1,
                'veterinarian_id' => 2,
                'diagnosis' => 'Dermatitis alérgica',
                'treatment' => 'Cremas tópicas y antihistamínicos',
                'notes' => 'Mejorar alimentación para prevenir recaídas',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
