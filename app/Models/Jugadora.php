<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jugadora extends Model
{
    use HasFactory;

    protected $fillable = [
        'equip_id',
        'nom',
        'cognoms',
        'data_naixement',
        'dorsal',
        'foto'
    ];

    // Relació: Una jugadora pertany a un Equip
    public function equip()
    {
        return $this->belongsTo(Equip::class);
    }
}