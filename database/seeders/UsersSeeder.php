<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    DB::table('users')->insert([
        'name' => 'Valentina Alvarez',
        'email' => 'valentina.alvarezi@autonoma.edu.co',
        'password' => Hash::make('hola123'),
        'role' => 'Administrador',
    ]);

    DB::table('users')->insert([
        'name' => 'Manuel Muñoz',
        'email' => 'manuel.m@autonoma.edu.co',
        'password' => Hash::make('hola123'),
        'role' => 'Veterinario',
    ]);
}

