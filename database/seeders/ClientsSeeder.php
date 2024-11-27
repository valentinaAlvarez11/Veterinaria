<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientsSeeder extends Seeder
{
    public function run()
    {
        Client::create([
            'name' => 'Juan Pérez',
            'email' => 'juan.perez@example.com',
            'phone' => '123456789',
            'address' => 'Calle Ficticia 123',
        ]);

        Client::create([
            'name' => 'Maria Gómez',
            'email' => 'maria.gomez@example.com',
            'phone' => '987654321',
            'address' => 'Avenida Siempre Viva 456',
        ]);

        Client::create([
            'name' => 'Carlos López',
            'email' => 'carlos.lopez@example.com',
            'phone' => '456789123',
            'address' => 'Calle Real 789',
        ]);
    }
}
