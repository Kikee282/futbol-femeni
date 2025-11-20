<?php

namespace App\Repositories;

use App\Models\Jugadora;

class JugadoraRepository extends BaseRepository
{
    public function __construct(Jugadora $jugadora)
    {
        // Passem el model al constructor del pare (BaseRepository)
        parent::__construct($jugadora);
    }

    // Aquí pots afegir mètodes personalitzats si cal
    // Per exemple: obtenir jugadores per equip
    public function getByEquip($equipId)
    {
        return $this->model->where('equip_id', $equipId)->get();
    }
}