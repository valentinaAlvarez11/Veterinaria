<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    public function run()
    {
        Service::create([
            'name' => 'Consulta Veterinaria',
            'description' => 'Consulta general para diagnóstico de mascotas',
            'specialty_id' => 1,
        ]);

        Service::create([
            'name' => 'Cirugía General',
            'description' => 'Intervención quirúrgica para casos de urgencia o planificación',
            'specialty_id' => 2,
        ]);
    }
}
