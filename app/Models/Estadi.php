<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estadi extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'ciutat', 'capacitat'];
    // Relació 1:N: Un estadi pot acollir molts partits
    public function partits()
    {
        return $this->hasMany(Partit::class);
    }

    // Relació 1:N: Un estadi és seu de molts equips
    public function equips()
    {
        return $this->hasMany(Equip::class);
    }
}