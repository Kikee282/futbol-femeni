@extends('layouts.app')

@section('title', 'Crear Equip')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Crear Nou Equip</h2>

    <form action="{{ route('equips.store') }}" method="POST">
        @csrf

        {{-- Camp Nom --}}
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Nom de l'Equip</label>
            <input type="text" name="nom" value="{{ old('nom') }}" class="w-full border p-2 rounded">
            @error('nom') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
        </div>

        {{-- NUEVO: Camp Ciutat --}}
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Ciutat</label>
            <input type="text" name="ciutat" value="{{ old('ciutat') }}" class="w-full border p-2 rounded">
            @error('ciutat') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
        </div>

        {{-- NUEVO: Camp Pressupost --}}
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Pressupost (€)</label>
            <input type="number" name="pressupost" value="{{ old('pressupost') }}" class="w-full border p-2 rounded">
            @error('pressupost') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
        </div>

        {{-- Camp Títols --}}
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Títols</label>
            <input type="number" name="titols" value="{{ old('titols', 0) }}" class="w-full border p-2 rounded">
            @error('titols') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
        </div>

        {{-- Select Estadi (Si ya tienes el componente hecho) --}}
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Estadi</label>
            <select name="estadi_id" class="w-full border p-2 rounded">
                @foreach($estadis as $estadi)
                    <option value="{{ $estadi->id }}">{{ $estadi->nom }}</option>
                @endforeach
            </select>
             @error('estadi_id') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Crear Equip</button>
    </form>
</div>
@endsection