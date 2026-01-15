<?php

namespace App\Policies;

use App\Models\Equip;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EquipPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Equip $equip): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
   

    public function update(User $user, Equip $equip)
    {
        // Puede editar si es ADMIN o si es el MANAGER del equipo
        return $user->role === 'admin' || $user->id === $equip->user_id;
    }


    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Equip $equip): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Equip $equip): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Equip $equip): bool
    {
        return false;
    }
}