<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equip extends Model
{
    use HasFactory;

    // IMPORTANTE: Asegúrate de que esta línea es idéntica
protected $fillable = ['nom', 'ciutat', 'pressupost', 'titols', 'estadi_id'];
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
}