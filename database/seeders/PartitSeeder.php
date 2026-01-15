<?php

namespace Database\Seeders;

use App\Models\Equip;
use App\Models\Partit;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PartitSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('es_ES'); 

        // 1. Obtenemos los IDs de los equipos
        $equips = Equip::all()->pluck('id')->toArray();
        $numEquips = count($equips);

        // Si hay menos de 2 equipos no podemos hacer liga
        if ($numEquips < 2) {
            $this->command->info('Es necessiten almenys 2 equips per crear la lliga.');
            return;
        }

        if ($numEquips % 2 != 0) {
            array_push($equips, null);
        }

        $numJornadas = count($equips) - 1;
        $partitsPerJornada = count($equips) / 2;

        $semanasParaLaMitad = floor($numJornadas); 
        $dataInici = Carbon::now()->subWeeks($semanasParaLaMitad)->startOfWeek(Carbon::SATURDAY);

        for ($j = 0; $j < $numJornadas; $j++) {
            $dataIda = $dataInici->copy()->addWeeks($j);
            // La vuelta empieza justo después de acabar la ida (aprox)
            $dataVuelta = $dataInici->copy()->addWeeks($j + $numJornadas + 1);

            for ($i = 0; $i < $partitsPerJornada; $i++) {
                $localId = $equips[$i];
                $visitantId = $equips[count($equips) - 1 - $i];

                if ($localId && $visitantId) {
                    $this->crearPartit($localId, $visitantId, $j + 1, $dataIda, $faker);
                    $this->crearPartit($visitantId, $localId, $j + 1 + $numJornadas, $dataVuelta, $faker);
                }
            }

            // Rotación de equipos (Algoritmo Round Robin)
            $primero = array_shift($equips);
            $ultimo = array_pop($equips);
            array_unshift($equips, $ultimo);
            array_unshift($equips, $primero);
        }
    }

    private function crearPartit($local, $visitant, $jornada, $fecha, $faker)
    {
        // Comprobamos si la fecha del partido ya ha pasado comparada con HOY
        $esPasado = $fecha->isPast();

        // Si ya pasó, ponemos goles. Si es futuro, null.
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
            'arbitre'       => $faker->name 
        ]);
    }
}