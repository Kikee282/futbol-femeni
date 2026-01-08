<?php

namespace App\Repositories;

use App\Models\Jugadora;
use Illuminate\Support\Collection;

// Implementem la interfície BaseRepository del teu projecte
class JugadoraRepository implements BaseRepository
{
    protected $model;

    public function __construct(Jugadora $model)
    {
        $this->model = $model;
    }

    public function getAll(): Collection
    {
        // Eager load 'equip' per evitar N+1 queries a la vista
        return $this->model->with('equip')->get();
    }

    // --- CORRECCIÓ ---
    // El mètode s'ha de dir 'find' per complir amb la 'BaseRepository'
    // També eliminem el tipus 'int' per quadrar amb la definició de la interfície
    public function find($id): ?Jugadora
    {
        return $this->model->find($id);
    }
    // --- FI DE LA CORRECCIÓ ---

    public function create(array $data): Jugadora
    {
        return $this->model->create($data);
    }

    // Eliminem el tipus 'int' de $id
    public function update($id, array $data): bool
    {
        // --- CORRECCIÓ INTERNA ---
        $model = $this->find($id); // Abans cridava a $this->getById($id)
        if ($model) {
            return $model->update($data);
        }
        return false;
    }

    // Eliminem el tipus 'int' de $id
    public function delete($id): bool
    {
        // --- CORRECCIÓ INTERNA ---
        $model = $this->find($id); // Abans cridava a $this->getById($id)
        if ($model) {
            return $model->delete();
        }
        return false;
    }
}