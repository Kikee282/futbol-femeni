<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partit extends Model
{
    use HasFactory;

    // Asegúrate de añadir 'arbitre' si lo creaste en el paso anterior
    protected $fillable = [
        'local_id', 'visitant_id', 'estadi_id', 'data', 'jornada', 'gols', 'arbitre'
    ];

    protected $casts = [
        'data' => 'date',
        'gols' => 'array', // Esto convierte el JSON de la BD a Array PHP automáticamente
    ];

    // --- ACCESSOR PARA EL RESULTADO ---
    // Esto permite usar $partit->resultat en la vista
    public function getResultatAttribute()
    {
        if ($this->gols && isset($this->gols['local']) && isset($this->gols['visitant'])) {
            return $this->gols['local'] . ' - ' . $this->gols['visitant'];
        }
        
        return null; // Si es null, la vista mostrará "PENDENT"
    }

    // --- RELACIONES ---
    // NOTA: Recomiendo cambiar los nombres a 'local' y 'visitant' para que sea
    // más fácil usarlos en la vista ($partit->local->nom)
    
    public function local() // Antes equipLocal
    {
        return $this->belongsTo(Equip::class, 'local_id');
    }

    public function visitant() // Antes equipVisitant
    {
        return $this->belongsTo(Equip::class, 'visitant_id');
    }

    public function estadi()
    {
        return $this->belongsTo(Estadi::class);
    }
}