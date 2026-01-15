<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partit extends Model
{
    use HasFactory;

    protected $fillable = [
        'local_id', 'visitant_id', 'estadi_id', 'data', 'jornada', 'gols', 'arbitre'
    ];

    protected $casts = [
        'data' => 'date',
        'gols' => 'array',
    ];

    public function getResultatAttribute()
    {
        if ($this->gols && isset($this->gols['local']) && isset($this->gols['visitant'])) {
            return $this->gols['local'] . ' - ' . $this->gols['visitant'];
        }
        
        return null; 
    }

    public function local() 
    {
        return $this->belongsTo(Equip::class, 'local_id');
    }

    public function visitant() 
    {
        return $this->belongsTo(Equip::class, 'visitant_id');
    }

    public function estadi()
    {
        return $this->belongsTo(Estadi::class);
    }

    public function getGolsLocalAttribute()
    {
        return $this->gols['local'] ?? null;
    }

    public function getGolsVisitantAttribute()
    {
        return $this->gols['visitant'] ?? null;
    }
}