<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Valentina Alvarez',
            'email' => 'valentina.alvarezi@autonoma.edu.co',
            'password' => Hash::make('hola123'),
        ]);
    }
}
