<?php

namespace App\Services;

use App\Repositories\JugadoraRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class JugadoraService
{
    protected $repository;

    // Definim les posicions per validar
    protected $posicions = ['Portera', 'Defensa', 'Migcampista', 'Davantera'];

    public function __construct(JugadoraRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Valida i crea una nova jugadora.
     */
    public function createJugadora(array $data)
    {
        $validator = Validator::make($data, [
            'nom' => 'required|string|min:3|max:150',
            'posicio' => ['required', Rule::in($this->posicions)],
            'data_naixement' => 'nullable|date_format:Y-m-d',
            'dorsal' => 'nullable|integer|min:1',
            'equip_id' => 'required|exists:equips,id', // Valida que l'equip existeixi
            'foto' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $this->repository->create($validator->validated());
    }

    /**
     * Valida i actualitza una jugadora existent.
     */
    public function updateJugadora(int $id, array $data)
    {
        $validator = Validator::make($data, [
            'nom' => 'required|string|min:3|max:150',
            'posicio' => ['required', Rule::in($this->posicions)],
            'data_naixement' => 'nullable|date_format:Y-m-d',
            'dorsal' => 'nullable|integer|min:1',
            'equip_id' => 'required|exists:equips,id',
            'foto' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $this->repository->update($id, $validator->validated());
    }
}