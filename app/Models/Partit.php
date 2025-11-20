<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partit extends Model
{
    use HasFactory;

    protected $fillable = [
        'local_id',
        'visitant_id',
        'estadi_id',
        'data',
        'jornada',
        'gols_local',
        'gols_visitant'
    ];

    // Equip Local
    public function local()
    {
        return $this->belongsTo(Equip::class, 'local_id');
    }

    // Equip Visitant
    public function visitant()
    {
        return $this->belongsTo(Equip::class, 'visitant_id');
    }

    // Estadi on es juga
    public function estadi()
    {
        return $this->belongsTo(Estadi::class);
    }
}