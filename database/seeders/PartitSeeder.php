<?php

namespace Database\Seeders;

use App\Models\Equip;
use App\Models\Partit;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker; // <--- Importante: Importamos Faker

class PartitSeeder extends Seeder
{
    public function run(): void
    {
        // Iniciamos Faker para generar nombres
        $faker = Faker::create('es_ES'); 

        $equips = Equip::all()->pluck('id')->toArray();
        $numEquips = count($equips);

        if ($numEquips % 2 != 0) {
            array_push($equips, null);
        }

        $numJornadas = count($equips) - 1;
        $partitsPerJornada = count($equips) / 2;

        $dataInici = Carbon::now()->subMonths(3)->startOfWeek(Carbon::SATURDAY);

        for ($j = 0; $j < $numJornadas; $j++) {
            $dataIda = $dataInici->copy()->addWeeks($j);
            $dataVuelta = $dataInici->copy()->addWeeks($j + $numJornadas + 1);

            for ($i = 0; $i < $partitsPerJornada; $i++) {
                $localId = $equips[$i];
                $visitantId = $equips[count($equips) - 1 - $i];

                if ($localId && $visitantId) {
                    // Pasamos la instancia de $faker a la función
                    $this->crearPartit($localId, $visitantId, $j + 1, $dataIda, $faker);
                    $this->crearPartit($visitantId, $localId, $j + 1 + $numJornadas, $dataVuelta, $faker);
                }
            }

            $primero = array_shift($equips);
            $ultimo = array_pop($equips);
            array_unshift($equips, $ultimo);
            array_unshift($equips, $primero);
        }
    }

    // Añadimos $faker como parámetro
    private function crearPartit($local, $visitant, $jornada, $fecha, $faker)
    {
        $esPasado = $fecha->isPast();

        $gols = $esPasado ? [
            'local' => rand(0, 5),
            'visitant' => rand(0, 5)
        ] : null;

        Partit::create([
            'local_id'      => $local,
            'visitant_id'   => $visitant,
            'jornada'       => $jornada,
            'data'          => $fecha->format('Y-m-d'),
            'gols'          => $gols,
            'arbitre'       => $faker->name // <--- AÑADIDO: Genera un nombre aleatorio
        ]);
    }
}