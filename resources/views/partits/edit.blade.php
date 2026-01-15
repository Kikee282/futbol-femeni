@extends('layouts.equip')
@section('title', 'Editar Partit')

@section('content')
<div class="max-w-md mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
    <h2 class="text-2xl font-bold mb-6 text-center">Editar Resultat ⚽</h2>
    
    <div class="mb-4 text-center text-gray-600">
        <p class="font-bold">{{ $partit->local->nom }} vs {{ $partit->visitant->nom }}</p>
        <p class="text-sm">{{ $partit->data }}</p>
    </div>

    <form action="{{ route('partits.update', $partit->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="flex justify-between gap-4 mb-6">
            {{-- Goles Local --}}
            <div class="w-1/2">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="gols_local">
                    {{ $partit->local->nom }} (Local)
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                    id="gols_local" type="number" name="gols_local" min="0" 
                    value="{{ old('gols_local', $partit->gols_local) }}">
            </div>

            {{-- Goles Visitante --}}
            <div class="w-1/2">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="gols_visitant">
                    {{ $partit->visitant->nom }} (Visitant)
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                    id="gols_visitant" type="number" name="gols_visitant" min="0" 
                    value="{{ old('gols_visitant', $partit->gols_visitant) }}">
            </div>
        </div>

        <div class="flex items-center justify-between">
            <button class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Actualitzar Resultat
            </button>
            <a href="{{ route('partits.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-600 hover:text-blue-800">
                Cancel·lar
            </a>
        </div>
    </form>
</div>
@endsection