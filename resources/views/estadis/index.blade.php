@extends('layouts.app')
@section('title', "Estadis")

@section('content')
    <h1 class="text-3xl font-bold text-blue-800 mb-6">Llistat d'Estadis</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-2 mb-4">{{ session('success') }}</div>
    @endif

    <p class="mb-4">
        <a href="{{ route('estadis.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded">+ Nou Estadi</a>
    </p>

    <table class="w-full border-collapse border border-gray-300">
        <thead class="bg-gray-200">
        <tr>
            <th class="border border-gray-300 p-2">Nom</th>
            <th class="border border-gray-300 p-2">Ciutat</th>
            <th class="border border-gray-300 p-2">Capacitat</th>
            <th class="border border-gray-300 p-2">Equip Principal</th>
        </tr>
        </thead>
        <tbody>
            {{-- Utilitzem el component <x-estadi> com demanava la pràctica --}}
            {{-- Aquest component l'has creat a: resources/views/components/estadi.blade.php --}}
            
            @forelse ($estadis as $estadi)
                <x-estadi :estadi="$estadi" />
            @empty
                <tr>
                    <td colspan="4" class="border border-gray-300 p-2 text-center">No hi ha estadis per mostrar.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection