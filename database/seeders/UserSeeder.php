<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Mateu Lahoz', // Nom que farem servir per assignar partits
            'email' => 'arbitre@futbol.com',
            'password' => Hash::make('password'),
            'role' => 'arbitre', // IMPORTANT: Rol 'arbitre'
        ]);
        
        // ... Si tens més usuaris, van aquí
    }
}