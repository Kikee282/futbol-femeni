@extends('layouts.app')

@section('title', 'Afegir Nova Jugadora')

@section('content')
    <h2 class="text-2xl font-bold mb-6">Afegir Nova Jugadora 👩‍</h2>

    <p class="mb-4">
        <a href="{{ route('jugadores.index') }}" class="text-blue-600 hover:text-blue-800">
            &larr; Tornar a la llista
        </a>
    </p>

    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 max-w-lg mx-auto">
        <form method="POST" action="{{ route('jugadores.store') }}">
            @csrf

            {{-- Camp Nom --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="nom">
                    Nom de la Jugadora:
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nom') border-red-500 @enderror" 
                       id="nom" name="nom" type="text" value="{{ old('nom') }}" required>
                @error('nom')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Camp Equip --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="equip">
                    Equip:
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('equip') border-red-500 @enderror" 
                       id="equip" name="equip" type="text" value="{{ old('equip') }}" required>
                @error('equip')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Camp Posició (SELECT) --}}
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="posicio">
                    Posició:
                </label>
                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('posicio') border-red-500 @enderror" 
                        id="posicio" name="posicio" required>
                    <option value="" disabled {{ old('posicio') ? '' : 'selected' }}>Selecciona una posició...</option>
                    
                    {{-- El controlador passa la variable $posicions --}}
                    @foreach ($posicions as $posicio)
                        <option value="{{ $posicio }}" {{ old('posicio') == $posicio ? 'selected' : '' }}>
                            {{ $posicio }}
                        </option>
                    @endforeach
                </select>
                @error('posicio')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Guardar Jugadora
                </button>
            </div>
        </form>
    </div>
@endsection