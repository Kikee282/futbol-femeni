<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Equip;

class Classificacio extends Component
{
    public function render()
    {
        // 1. Obtenim tots els equips carregant els seus partits per optimitzar
        $equips = Equip::with(['partitsLocal', 'partitsVisitant'])->get();

        // 2. Transformem la col·lecció per calcular estadístiques
        $classificacio = $equips->map(function ($equip) {
            $punts = 0;
            $golsFavor = 0;
            $golsContra = 0;
            $jugats = 0;
            $guanyats = 0;
            $empatats = 0;
            $perduts = 0;

            // Processar partits com a LOCAL
            foreach ($equip->partitsLocal as $partit) {
                // Només comptem si el partit té resultat (gols no és null)
                if ($partit->gols_local !== null) {
                    $jugats++;
                    $golsFavor += $partit->gols_local;
                    $golsContra += $partit->gols_visitant;

                    if ($partit->gols_local > $partit->gols_visitant) {
                        $punts += 3; $guanyats++;
                    } elseif ($partit->gols_local == $partit->gols_visitant) {
                        $punts += 1; $empatats++;
                    } else {
                        $perduts++;
                    }
                }
            }

            // Processar partits com a VISITANT
            foreach ($equip->partitsVisitant as $partit) {
                if ($partit->gols_visitant !== null) {
                    $jugats++;
                    $golsFavor += $partit->gols_visitant;
                    $golsContra += $partit->gols_local;

                    if ($partit->gols_visitant > $partit->gols_local) {
                        $punts += 3; $guanyats++;
                    } elseif ($partit->gols_visitant == $partit->gols_local) {
                        $punts += 1; $empatats++;
                    } else {
                        $perduts++;
                    }
                }
            }

            // Afegim les dades calculades a l'objecte equip
            $equip->stats = [
                'punts' => $punts,
                'pj' => $jugats,
                'pg' => $guanyats,
                'pe' => $empatats,
                'pp' => $perduts,
                'gf' => $golsFavor,
                'gc' => $golsContra,
                'dg' => $golsFavor - $golsContra,
            ];

            return $equip;
        });

        // 3. Ordenem: Primer per PUNTS (desc), després per DIFERÈNCIA DE GOLS (desc)
        $classificacio = $classificacio->sort(function ($a, $b) {
            if ($a->stats['punts'] === $b->stats['punts']) {
                return $b->stats['dg'] <=> $a->stats['dg']; // Si empaten a punts, mira DG
            }
            return $b->stats['punts'] <=> $a->stats['punts'];
        });

        return view('livewire.classificacio', [
            'equips' => $classificacio
        ]);
    }
}