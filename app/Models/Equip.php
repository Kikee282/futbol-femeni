<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equip extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'ciutat', 'pressupost', 'titols', 'estadi_id', 'escut'];
    public function estadi()
    {
        return $this->belongsTo(Estadi::class);
    }

    public function jugadores()
    {
        return $this->hasMany(Jugadora::class);
    }
    
    // Relaciones para los partidos
    public function partitsLocal()
    {
        return $this->hasMany(Partit::class, 'local_id');
    }

    public function partitsVisitant()
    {
        return $this->hasMany(Partit::class, 'visitant_id');
    }

    public function manager()
    {
        return $this->hasOne(User::class);
    }
    public function getUltimsResultatsAttribute()
    {
    // Buscamos los últimos 5 partidos jugados (donde hay goles)
    // Buscamos tanto local como visitante
    $partits = Partit::where(function($q) {
                        $q->where('local_id', $this->id)
                        ->orWhere('visitant_id', $this->id);
                    })
                    ->whereNotNull('gols') // Solo jugados
                    ->orderBy('data', 'desc')
                    ->take(5)
                    ->get();

    $resultats = [];

    foreach ($partits as $partit) {
        // Determinamos si ganamos, empatamos o perdimos
        $esLocal = $partit->local_id === $this->id;
        $golsFavor = $esLocal ? $partit->gols_local : $partit->gols_visitant;
        $golsContra = $esLocal ? $partit->gols_visitant : $partit->gols_local;

        if ($golsFavor > $golsContra) $resultats[] = '✅'; // Victoria
        elseif ($golsFavor === $golsContra) $resultats[] = '➖'; // Empate
        else $resultats[] = '❌'; // Derrota
    }

    return $resultats; // Devuelve array tipo ['✅', '❌', '✅']
    }
}