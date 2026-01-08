@extends('layouts.app')

@section('title', 'Editar Jugadora')

@section('content')
    <h2 class="text-2xl font-bold mb-6">Editar Jugadora: {{ $jugadora->nom }}</h2>

    <p class="mb-4"><a href="{{ route('jugadores.index') }}" class="text-blue-600">&larr; Tornar</a></p>

    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 max-w-lg mx-auto">
        {{-- Canviem el mètode a PUT i l'acció a 'update' --}}
        <form method="POST" action="{{ route('jugadores.update', $jugadora) }}">
            @csrf
            @method('PUT')

            {{-- Camp Nom --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="nom">Nom:</label>
                {{-- Omplim amb el valor de $jugadora->nom --}}
                <input class="shadow ... @error('nom') border-red-500 @enderror" 
                       id="nom" name="nom" type="text" value="{{ old('nom', $jugadora->nom) }}" required>
                @error('nom')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Camp Posició (SELECT) --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="posicio">Posició:</label>
                <select class="shadow ... @error('posicio') border-red-500 @enderror" id="posicio" name="posicio" required>
                    @foreach ($posicions as $posicio)
                        {{-- Marquem la posició actual de la jugadora --}}
                        <option value="{{ $posicio }}" {{ old('posicio', $jugadora->posicio) == $posicio ? 'selected' : '' }}>
                            {{ $posicio }}
                        </option>
                    @endforeach
                </select>
                @error('posicio')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>
            
            {{-- Camp Equip (SELECT) --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="equip_id">Equip:</label>
                <select class="shadow ... @error('equip_id') border-red-500 @enderror" id="equip_id" name="equip_id" required>
                    @foreach ($equips as $equip)
                        {{-- Marquem l'equip actual de la jugadora --}}
                        <option value="{{ $equip->id }}" {{ old('equip_id', $jugadora->equip_id) == $equip->id ? 'selected' : '' }}>
                            {{ $equip->nom }}
                        </option>
                    @endforeach
                </select>
                @error('equip_id')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>
            
            {{-- Altres camps (Dorsal, Data Naixement...) --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="dorsal">Dorsal:</label>
                <input class="shadow ... @error('dorsal') border-red-500 @enderror" 
                       id="dorsal" name="dorsal" type="number" value="{{ old('dorsal', $jugadora->dorsal) }}">
                @error('dorsal')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">
                    Actualitzar Jugadora
                </button>
            </div>
        </form>
    </div>
@endsection