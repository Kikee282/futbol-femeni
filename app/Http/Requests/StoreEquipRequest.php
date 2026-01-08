<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEquipRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom' => 'required|string|unique:equips,nom|max:255',
            'ciutat' => 'required|string|max:255', // <--- AÑADIDO
            'pressupost' => 'required|numeric|min:0', // <--- AÑADIDO
            'titols' => 'integer|min:0',
            'estadi_id' => 'required|exists:estadis,id',
        ];
    }
}