<?php

namespace App\Services;

use App\Repositories\JugadoraRepository;
use App\Models\Jugadora;
use Illuminate\Http\UploadedFile; // Importante para manejar archivos
use Illuminate\Support\Facades\Storage;

class JugadoraService
{
    protected $repository;

    public function __construct(JugadoraRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Crea una nova jugadora i gestiona la foto si n'hi ha.
     */
    public function createJugadora(array $data, ?UploadedFile $foto = null): Jugadora
    {
        // 1. Si ens passen una foto, la guardem al disc i actualitzem la ruta a l'array
        if ($foto) {
            $data['foto'] = $foto->store('jugadores', 'public');
        }

        // 2. Cridem al repositori per guardar a la BD (les dades ja venen validades del Request)
        return $this->repository->create($data);
    }

    /**
     * Actualitza una jugadora i gestiona el canvi de foto.
     */
    public function update($id, array $data): Jugadora
    {
        // 1. Buscamos la jugadora
        $jugadora = Jugadora::findOrFail($id);
        
        // 2. Actualizamos los datos (esto devuelve bool)
        $jugadora->update($data);
        
        // 3. IMPORTANTE: Devolvemos el objeto jugadora, no el booleano
        return $jugadora;
    }
}