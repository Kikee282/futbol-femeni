@extends('layouts.app')

@section('title', 'Detalls de ' . $estadi->nom)

@section('content')
    <h2 class="text-2xl font-bold mb-6">Detalls de l'Estadi: {{ $estadi->nom }} 🏟️</h2>

    <p class="mb-4">
        <a href="{{ route('estadis.index') }}" class="text-blue-600 hover:text-blue-800">
            &larr; Tornar al llistat d'estadis
        </a>
    </p>

    {{-- Targeta de Detalls de l'Estadi --}}
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 max-w-lg mx-auto">
        <h3 class="text-xl font-semibold mb-4">{{ $estadi->nom }}</h3>
        
        <div classDetails">
            <p class="mb-2"><strong>Capacitat:</strong> {{ number_format($estadi->capacitat, 0, ',', '.') }} espectadors</p>
        </div>
    </div>

    {{-- Equips que juguen aquí (Relació 1:N) --}}
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 max-w-lg mx-auto">
        <h4 class="text-lg font-semibold mb-4">Equips Locals ({{ $estadi->equips->count() }})</h4>
        
        @if ($estadi->equips->count() > 0)
            <ul class="list-disc pl-5">
                @foreach ($estadi->equips as $equip)
                    <li class="mb-1">{{ $equip->nom }} ({{ $equip->ciutat }})</li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">Aquest estadi no és la seu principal de cap equip.</p>
        @endif
    </div>

    {{-- Partits jugats aquí (Relació 1:N) --}}
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 max-w-lg mx-auto">
        <h4 class="text-lg font-semibold mb-4">Pròxims Partits ({{ $estadi->partits->count() }})</h4>
        
        @if ($estadi->partits->count() > 0)
            <ul class="list-disc pl-5">
                @foreach ($estadi->partits as $partit)
                    <li class="mb-1">
                        {{ $partit->data->format('d/m/Y') }} - {{ $partit->equipLocal->nom }} vs {{ $partit->equipVisitant->nom }}
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">No hi ha partits registrats en aquest estadi.</p>
        @endif
    </div>
@endsection