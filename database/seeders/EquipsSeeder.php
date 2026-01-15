<?php

namespace Database\Seeders;

use App\Models\Equip;
use App\Models\Estadi;
use App\Models\User; // <--- IMPORTANTE: No olvides importar el modelo User
use Illuminate\Database\Seeder;

class EquipsSeeder extends Seeder
{
    public function run(): void
    {
        // 1. BARÇA
        $campNou = Estadi::firstOrCreate(
            ['nom' => 'Camp Nou'], 
            ['capacitat' => 99354]
        );

        // Guardamos el equipo en una variable ($barca)
        $barca = Equip::create([
            'nom' => 'Barça Femení',
            'ciutat' => 'Barcelona',
            'pressupost' => 12000000,
            'titols' => 30,
            'estadi_id' => $campNou->id 
        ]);

        // Creamos su Manager asignándole el equipo
        User::create([
            'name' => 'Manager Barça',
            'email' => 'manager.barca@futbol.com',
            'password' => bcrypt('password'), // Contraseña genérica
            'role' => 'admin', // O el rol que prefieras
            'equip_id' => $barca->id, // <--- ASIGNACIÓN
        ]);

        // 2. ATLÉTICO
        $wanda = Estadi::firstOrCreate(
            ['nom' => 'Wanda Metropolitano'], 
            ['capacitat' => 68456]
        );

        $atleti = Equip::create([
            'nom' => 'Atlètic de Madrid',
            'ciutat' => 'Madrid',
            'pressupost' => 5000000,
            'titols' => 10,
            'estadi_id' => $wanda->id
        ]);

        User::create([
            'name' => 'Manager Atleti',
            'email' => 'manager.atleti@futbol.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'equip_id' => $atleti->id,
        ]);

        // 3. REAL MADRID
        $bernabeu = Estadi::firstOrCreate(
            ['nom' => 'Santiago Bernabéu'], 
            ['capacitat' => 81044]
        );

        $madrid = Equip::create([
            'nom' => 'Real Madrid Femení',
            'ciutat' => 'Madrid',
            'pressupost' => 8000000,
            'titols' => 5,
            'estadi_id' => $bernabeu->id
        ]);

        User::create([
            'name' => 'Manager Madrid',
            'email' => 'manager.madrid@futbol.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'equip_id' => $madrid->id,
        ]);

        // 4. RESTO DE EQUIPOS (Factory)
        // Usamos 'each' para crear un manager por cada equipo generado automáticamente
        Equip::factory()->count(15)->create()->each(function ($equip) {
            
            // Generamos un email único usando el ID del equipo
            User::create([
                'name' => 'Manager ' . $equip->nom,
                'email' => 'manager.' . $equip->id . '@futbol.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'equip_id' => $equip->id,
            ]);
            
        });
    }
}