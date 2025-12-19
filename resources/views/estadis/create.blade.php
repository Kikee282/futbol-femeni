@extends('layouts.app')

@section('title', 'Afegir Nou Estadi')

@section('content')
    <h2>Afegir Nou Estadi 🏟️</h2>

    <p><a href="{{ route('estadis.index') }}" style="color: #007bff; text-decoration: none;">← Tornar a la llista</a></p>

    {{-- Estils bàsics per al formulari (pots moure'ls a guias.css) --}}
    <style>
        .form-card { border: 1px solid #dee2e6; border-radius: 8px; padding: 20px; background-color: white; box-shadow: 0 1px 3px rgba(0,0,0,0.05); max-width: 600px; margin: 20px auto; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
        .form-group input { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .error-message { color: red; font-size: 0.85em; margin-top: 5px; }
        .submit-button { background-color: #28a745; color: white; padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s; }
        .submit-button:hover { background-color: #218838; }
    </style>

    <div class="form-card">
        <form method="POST" action="{{ route('estadis.store') }}">
            {{-- Token de seguretat CSRF (obligatori) --}}
            @csrf

            <div class="form-group">
                <label for="nom">Nom de l'Estadi:</label>
                {{-- 'old()' manté el valor si la validació falla --}}
                <input type="text" id="nom" name="nom" value="{{ old('nom') }}" required>
                {{-- '@error' mostra l'error de validació --}}
                @error('nom')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="ciutat">Ciutat:</label>
                <input type="text" id="ciutat" name="ciutat" value="{{ old('ciutat') }}" required>
                @error('ciutat')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="capacitat">Capacitat:</label>
                <input type="number" id="capacitat" name="capacitat" value="{{ old('capacitat') }}" required min="0">
                @error('capacitat')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="equip_principal">Equip Principal:</label>
                <input type="text" id="equip_principal" name="equip_principal" value="{{ old('equip_principal') }}" required>
                @error('equip_principal')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="submit-button">Guardar Estadi</button>
        </form>
    </div>
@endsection