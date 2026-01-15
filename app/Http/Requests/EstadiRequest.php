<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstadiRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Solo administradores pueden gestionar estadios
        return $this->user()->role === 'admin';
    }

    public function rules(): array
    {
        return [
            'nom' => 'required|string|max:255',
            // AQUI CUMPLIMOS: "capacitat numèric positiu"
            'capacitat' => 'required|integer|min:1',
        ];
    }
}