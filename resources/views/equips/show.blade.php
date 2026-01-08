@extends('layouts.app')

@section('title', 'Detalls de ' . $equip->nom)

@section('content')
    <h2 class="text-2xl font-bold mb-6">Detalls de l'Equip: {{ $equip->nom }} ⚽</h2>

    <p class="mb-4">
        <a href="{{ route('equips.index') }}" class="text-blue-600 hover:text-blue-800">
            &larr; Tornar al llistat d'equips
        </a>
    </p>

    {{-- Targeta de Detalls de l'Equip --}}
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 max-w-lg mx-auto">
        <h3 class="text-xl font-semibold mb-4">{{ $equip->nom }}</h3>
        
        <div class="classDetails">
            <p class="mb-2"><strong>Ciutat:</strong> {{ $equip->ciutat }}</p>
            <p class="mb-2"><strong>Pressupost:</strong> {{ number_format($equip->pressupost, 0, ',', '.') }} €</p>
            
            {{-- Mostrem l'estadi (Relació N:1) --}}
            @if ($equip->estadi)
                <p class="mb-2"><strong>Estadi:</strong> {{ $equip->estadi->nom }} (Capacitat: {{ number_format($equip->estadi->capacitat, 0, ',', '.') }})</p>
            @endif
        </div>
    </div>

    {{-- Llistat de Jugadores (Relació 1:N) --}}
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 max-w-lg mx-auto">
        <h4 class="text-lg font-semibold mb-4">Plantilla ({{ $equip->jugadores->count() }} jugadores)</h4>
        
        @if ($equip->jugadores->count() > 0)
            <ul class="list-disc pl-5">
                @foreach ($equip->jugadores as $jugadora)
                    <li class="mb-1">{{ $jugadora->nom }} ({{ $jugadora->posicio }})</li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">Aquest equip encara no té jugadores registrades.</p>
        @endif
    </div>
@endsection