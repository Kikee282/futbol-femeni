<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jugadora;
use App\Models\Equip;

class JugadoraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Obtenim els IDs dels equips (per assegurar-nos que existeixen)
        // Assumim que tens equips amb aquests noms creats al EquipSeeder
        $barca = Equip::where('nom', 'LIKE', '%Barcelona%')->first();
        $madrid = Equip::where('nom', 'LIKE', '%Real Madrid%')->first();
        $atletic = Equip::where('nom', 'LIKE', '%Atlètic%')->first();

        // Si no troba els equips, creem IDs ficticis o parem (per evitar errors)
        $idBarca = $barca ? $barca->id : null;
        $idMadrid = $madrid ? $madrid->id : null;
        $idAtletic = $atletic ? $atletic->id : null;

        // 2. Llista de Jugadores
        $jugadores = [
            [
                'nom' => 'Alexia Putellas',
                'posicio' => 'Migcampista',
                'equip_id' => $idBarca,
                'data_naixement' => '1994-02-04',
                'dorsal' => 11,
                'foto' => 'https://via.placeholder.com/150', // Foto de prova
            ],
            [
                'nom' => 'Aitana Bonmatí',
                'posicio' => 'Migcampista',
                'equip_id' => $idBarca,
                'data_naixement' => '1998-01-18',
                'dorsal' => 14,
                'foto' => 'https://via.placeholder.com/150',
            ],
            [
                'nom' => 'Caroline Graham Hansen',
                'posicio' => 'Davantera',
                'equip_id' => $idBarca,
                'data_naixement' => '1995-02-18',
                'dorsal' => 10,
                'foto' => 'https://via.placeholder.com/150',
            ],
            [
                'nom' => 'Misa Rodríguez',
                'posicio' => 'Portera',
                'equip_id' => $idMadrid,
                'data_naixement' => '1999-07-22',
                'dorsal' => 1,
                'foto' => 'https://via.placeholder.com/150',
            ],
            [
                'nom' => 'Olga Carmona',
                'posicio' => 'Defensa',
                'equip_id' => $idMadrid,
                'data_naixement' => '2000-06-12',
                'dorsal' => 7,
                'foto' => 'https://via.placeholder.com/150',
            ],
            [
                'nom' => 'Lola Gallardo',
                'posicio' => 'Portera',
                'equip_id' => $idAtletic,
                'data_naixement' => '1993-06-10',
                'dorsal' => 13,
                'foto' => 'https://via.placeholder.com/150',
            ],
        ];

        // 3. Inserim les dades
        foreach ($jugadores as $dades) {
            // Només creem la jugadora si tenim un equip vàlid (opcional)
            if ($dades['equip_id']) {
                Jugadora::create($dades);
            }
        }
    }
}