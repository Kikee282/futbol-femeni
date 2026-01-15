<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PartitRequest extends FormRequest
{
    // AQUI CUMPLIMOS: "Àrbitres només per modificar resultats dels seus partits"
    public function authorize(): bool
    {
        $user = $this->user();
        
        // 1. Si es Admin, permiso total
        if ($user->role === 'admin') {
            return true;
        }

        // 2. Si es Arbitre, comprobamos que sea SU partido
        // Obtenemos el partido de la ruta (ej: /partits/{partit})
        $partit = $this->route('partit');

        // Si estamos editando (existe el partido) y el usuario es el árbitro asignado
        if ($partit && $user->name === $partit->arbitre) { // Asumiendo que guardas el nombre, si guardas ID usa $partit->arbitre_id
            return true;
        }

        return false;
    }

    // AQUI CUMPLIMOS: "gols (numèrics positius)"
    public function rules(): array
    {
        return [
            'gols_local' => 'required|integer|min:0',
            'gols_visitant' => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
    return [
        'local_id.required' => 'L\'equip local és obligatori.',
        'visitant_id.required' => 'L\'equip visitant és obligatori.',
        'visitant_id.different' => 'L\'equip visitant no pot ser el mateix que el local.',
        'gols_local.min' => 'Els gols no poden ser negatius.',
        'gols_visitant.min' => 'Els gols no poden ser negatius.',
        'data.required' => 'La data del partit és necessària.',
    ];
    }
}