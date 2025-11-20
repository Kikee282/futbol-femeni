<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    // ✅ Aquesta propietat és la clau. Ha de ser protected per ser accessible als fills
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    // Mètodes comuns per a tots els repositories
    public function getAll()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $record = $this->find($id);
        $record->update($data);
        return $record;
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}