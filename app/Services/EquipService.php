<?php

namespace App\Services;

use App\Models\Equip;
use App\Repositories\EquipRepository;
use Illuminate\Http\UploadedFile; // <--- CORREGIDO: Usar el de Laravel
use Illuminate\Support\Facades\Storage; // <--- CORREGIDO: Importación completa

class EquipService 
{
    // Definimos la propiedad
    protected $equipRepository;

    public function __construct(EquipRepository $equipRepository)
    {
        $this->equipRepository = $equipRepository;
    }

    /**
     * Este es el método que usa tu Test Unitario y el Controlador para crear
     */
    public function createEquip(array $data, ?UploadedFile $escut = null): Equip
    {
        // Si nos pasan un fichero de imagen, lo guardamos en disco
        if ($escut) {
            $data['escut'] = $escut->store('escuts', 'public');
        }

        // Llamamos al repositorio para guardar en BD
        return $this->equipRepository->create($data);
    }

    public function actualitzar(int $id, array $data, ?UploadedFile $escut = null): Equip 
    {
        // Buscamos el equipo para poder borrar la foto antigua si hace falta
        $equip = $this->equipRepository->find($id);

        if ($escut) {
            // Borramos el antiguo si existe
            if ($equip && $equip->escut) {
                Storage::disk('public')->delete($equip->escut);
            }
            $data['escut'] = $escut->store('escuts', 'public');
        }

        // Esto devuelve el objeto Equip, por eso cambiamos el tipo arriba
        return $this->equipRepository->update($id, $data);
    }

    public function trobar($id)
    {
        // CORREGIDO: Usamos $this->equipRepository, no $this->repo
        return $this->equipRepository->find($id);
    }

    public function eliminar(int $id): void 
    {
        $equip = $this->equipRepository->find($id);
        
        if ($equip && $equip->escut) {
            Storage::disk('public')->delete($equip->escut);
        }
        
        $this->equipRepository->delete($id);
    }

    public function llistar() 
    {
        // Asumiendo que tu repositorio tiene un método getAll() o all()
        // Si usas el método estándar de Eloquent sería all()
        return $this->equipRepository->all(); 
    }
}