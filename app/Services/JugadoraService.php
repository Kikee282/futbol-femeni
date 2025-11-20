<?php

namespace App\Services;

use App\Repositories\JugadoraRepository;
use Illuminate\Database\Eloquent\Collection;

class JugadoraService
{
    protected $jugadoraRepository;

    public function __construct(JugadoraRepository $jugadoraRepository)
    {
        $this->jugadoraRepository = $jugadoraRepository;
    }

    public function getAll(): Collection
    {
        return $this->jugadoraRepository->getAll();
    }

    public function create(array $data)
    {
        // Aquí podries afegir lògica extra abans de guardar
        // per exemple, pujar la foto si ve en el array $data
        
        return $this->jugadoraRepository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->jugadoraRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->jugadoraRepository->delete($id);
    }

    public function find($id)
    {
        return $this->jugadoraRepository->find($id);
    }
    
    // Mètode extra per al punt 2 de l'exercici (mostrar equips)
    public function getJugadoresPerEquip($equipId)
    {
        return $this->jugadoraRepository->getByEquip($equipId);
    }
}