@extends('layouts.equip')
@section('title', $partit->local->nom . ' vs ' . $partit->visitant->nom)

@section('content')
<div class="max-w-4xl mx-auto mt-8">
    {{-- Marcador --}}
    <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
        <div class="bg-gray-800 text-white p-4 text-center">
            <h2 class="text-xl uppercase tracking-widest">Jornada {{ $partit->jornada }}</h2>
            <p class="text-sm opacity-75">{{ \Carbon\Carbon::parse($partit->data)->format('d/m/Y') }}</p>
            @if($partit->arbitre)
                <p class="text-xs mt-2 text-yellow-400">Àrbitre: {{ $partit->arbitre }}</p>
            @endif
        </div>
        
        <div class="flex justify-between items-center p-8 bg-gray-50">
            {{-- Local --}}
            <div class="text-center w-1/3">
                <h3 class="text-2xl font-bold mb-2">{{ $partit->local->nom }}</h3>
                <span class="text-gray-500 text-sm">Local</span>
            </div>

            {{-- Resultado --}}
            <div class="text-center w-1/3">
                @if($partit->gols)
                    <span class="text-5xl font-extrabold text-blue-900">
                        {{ $partit->gols['local'] ?? 0 }} - {{ $partit->gols['visitant'] ?? 0 }}
                    </span>
                @else
                    <span class="text-4xl font-bold text-gray-400">VS</span>
                    <p class="text-sm mt-2 text-blue-600 font-semibold">PENDENT</p>
                @endif
            </div>

            {{-- Visitante --}}
            <div class="text-center w-1/3">
                <h3 class="text-2xl font-bold mb-2">{{ $partit->visitant->nom }}</h3>
                <span class="text-gray-500 text-sm">Visitant</span>
            </div>
        </div>
        
        <div class="bg-gray-100 p-4 text-center border-t">
            <p>🏟️ Estadi: <strong>{{ $partit->estadi->nom ?? 'Desconegut' }}</strong></p>
        </div>
    </div>
</div>
@endsection