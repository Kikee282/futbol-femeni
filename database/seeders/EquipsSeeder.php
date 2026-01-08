<?php

namespace Database\Seeders;

use App\Models\Equip;
use App\Models\Estadi;
use Illuminate\Database\Seeder;

class EquipsSeeder extends Seeder
{
    public function run(): void
    {
        // 1. BARÇA
        // Buscamos o creamos el estadio (Solo usamos nom y capacitat, que son los campos reales de tu tabla estadis)
        $campNou = Estadi::firstOrCreate(
            ['nom' => 'Camp Nou'], 
            ['capacitat' => 99354]
        );

        Equip::create([
            'nom' => 'Barça Femení',
            'ciutat' => 'Barcelona',
            'pressupost' => 12000000,
            'titols' => 30,
            'estadi_id' => $campNou->id // <--- Esto falla si no está en el $fillable de Equip.php
        ]);

        // 2. ATLÉTICO
        $wanda = Estadi::firstOrCreate(
            ['nom' => 'Wanda Metropolitano'], 
            ['capacitat' => 68456]
        );

        Equip::create([
            'nom' => 'Atlètic de Madrid',
            'ciutat' => 'Madrid',
            'pressupost' => 5000000,
            'titols' => 10,
            'estadi_id' => $wanda->id
        ]);

        // 3. REAL MADRID
        $bernabeu = Estadi::firstOrCreate(
            ['nom' => 'Santiago Bernabéu'], 
            ['capacitat' => 81044]
        );

        Equip::create([
            'nom' => 'Real Madrid Femení',
            'ciutat' => 'Madrid',
            'pressupost' => 8000000,
            'titols' => 5,
            'estadi_id' => $bernabeu->id
        ]);

        // 4. RESTO DE EQUIPOS
        Equip::factory()->count(15)->create();
    }
}