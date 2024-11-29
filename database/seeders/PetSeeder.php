<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Pet;
use Illuminate\Database\Seeder;

class PetSeeder extends Seeder
{
    public function run()
    {
        $client = Client::find(1);
        Pet::create([
            'name' => 'Rex',
            'breed' => 'Pastor Alemán',
            'age' => 5,
            'medical_conditions' => 'Ninguna',
            'client_id' => $client->id,
        ]);

        Pet::create([
            'name' => 'Mia',
            'breed' => 'Bulldog Francés',
            'age' => 3,
            'medical_conditions' => 'Alergias estacionales',
            'client_id' => $client->id,
        ]);
    }
}
