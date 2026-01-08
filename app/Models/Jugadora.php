<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jugadora extends Model
{
    use HasFactory;

    // Forcem el nom de la taula (per al plural català)
    protected $table = 'jugadores'; 

    protected $fillable = [
        'nom', 'posicio', 'equip_id', 'data_naixement', 'dorsal', 'foto'
    ];

    protected $casts = [
        'data_naixement' => 'date',
    ];

    // Relació N:1: Una jugadora pertany a un equip
    public function equip()
    {
        return $this->belongsTo(Equip::class);
    }
}