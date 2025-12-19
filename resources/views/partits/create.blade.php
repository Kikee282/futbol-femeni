@extends('layouts.app')

@section('title', 'Programar Nou Partit')

@section('content')
    <h2 class="text-2xl font-bold mb-6">Programar Nou Partit 📅</h2>

    <p class="mb-4">
        <a href="{{ route('partits.index') }}" class="text-blue-600 hover:text-blue-800">
            &larr; Tornar a la llista
        </a>
    </p>

    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 max-w-lg mx-auto">
        <form method="POST" action="{{ route('partits.store') }}">
            @csrf

            {{-- Camp Local --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="local">Equip Local:</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('local') border-red-500 @enderror" 
                       id="local" name="local" type="text" value="{{ old('local') }}" required>
                @error('local')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Camp Visitant --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="visitant">Equip Visitant:</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('visitant') border-red-500 @enderror" 
                       id="visitant" name="visitant" type="text" value="{{ old('visitant') }}" required>
                @error('visitant')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Camp Data (type=date) --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="data">Data (YYYY-MM-DD):</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('data') border-red-500 @enderror" 
                       id="data" name="data" type="date" value="{{ old('data', now()->format('Y-m-d')) }}" required>
                @error('data')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Camp Resultat (Opcional, Regex) --}}
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="resultat">Resultat (Opcional, format 2-1):</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('resultat') border-red-500 @enderror" 
                       id="resultat" name="resultat" type="text" value="{{ old('resultat') }}" placeholder="Ex: 2-1">
                @error('resultat')
                    {{-- Aquest missatge serà el personalitzat del controlador --}}
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Programar Partit
                </button>
            </div>
        </form>
    </div>
@endsection