<?php

namespace App\Policies;

use App\Models\Partit;
use App\Models\User;

class PartitPolicy
{
    /**
     * Determina si el usuario puede actualizar el partido.
     */
    public function update(User $user, Partit $partit): bool
    {
        // 1. Si es administrador, TIENE PERMISO SIEMPRE
        if ($user->role === 'admin') {
            return true;
        }

        // 2. Si es árbitro, TIENE PERMISO SOLO SI ES SU PARTIDO
        // Comparamos el nombre del árbitro del partido con el nombre del usuario
        if ($user->role === 'arbitre' && $partit->arbitre === $user->name) {
            return true;
        }

        // 3. En cualquier otro caso, DENEGADO
        return false;
    }
}