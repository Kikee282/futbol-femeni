<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Equip;

class JugadoraRequest extends FormRequest
{
    // AQUI CUMPLIMOS: "Managers només sobre el seu equip"
    public function authorize(): bool
    {
        $user = $this->user();

        if ($user->role === 'admin') return true;

        // Si es manager, verificamos que el equipo que intenta asignar a la jugadora sea el suyo
        if ($user->equip_id == $this->input('equip_id')) {
            return true;
        }
        
        // Si intenta editar una jugadora existente
        $jugadora = $this->route('jugadora');
        if ($jugadora && $user->equip_id == $jugadora->equip_id) {
            return true;
        }

        return false;
    }

    public function rules(): array
    {
        return [
            'nom' => 'required|string|max:255',
            // AQUI CUMPLIMOS: "dorsal numèric positiu"
            'dorsal' => 'required|integer|min:1', 
            // AQUI CUMPLIMOS: "data_naixement mínima de 16 anys" (before: hace 16 años)
            'data_naixement' => 'required|date|before:-16 years', 
            // AQUI CUMPLIMOS: "foto tipus .png i mida màxima"
            'foto' => 'nullable|image|mimes:png|max:2048', 
            'equip_id' => 'required|exists:equips,id',
        ];
    }
}