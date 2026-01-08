@extends('layouts.app')

@section('title', 'Llistat de Partits')

@section('content')
    <h2 class="text-2xl font-bold mb-6">Llistat de Partits ⚽📅</h2>

    <p class="mb-4">
        <a href="{{ route('partits.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Nou Partit
        </a>
    </p>

    {{-- Missatge d'èxit --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="bg-white shadow-md rounded my-6">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">Local</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">Visitant</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">Data</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">Resultat</th>
                </tr>
            </thead>
            {{-- Filtros --}}
    <div class="bg-gray-100 p-4 rounded mb-6">
        <form action="{{ route('partits.index') }}" method="GET" class="flex gap-4 items-end">
            <div>
                <label for="arbitre" class="block text-sm font-medium text-gray-700">Filtrar per Àrbitre</label>
                <input type="text" name="arbitre" value="{{ request('arbitre') }}" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        placeholder="Nom de l'àrbitre...">
            </div>
            
            <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700">
                🔍 Buscar
            </button>
            
            @if(request()->has('arbitre'))
                <a href="{{ route('partits.index') }}" class="text-red-600 underline text-sm ml-2">Netejar filtres</a>
            @endif
        </form>
    </div>
            <tbody class="bg-white">
                @if (isset($partits) && count($partits) > 0)
                    @foreach ($partits as $partit)
                        <tr class="hover:bg-gray-100">
                            {{-- CORRECCIÓN AQUÍ: Usamos ->local->nom y ->visitant->nom --}}
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <x-equip-mini :nom="$partit->local->nom"/>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <x-equip-mini :nom="$partit->visitant->nom"/>
                            </td>
                            
                            {{-- CORRECCIÓN: Mejor usar sintaxis de objeto para la fecha también --}}
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm">
                                {{ \Carbon\Carbon::parse($partit->data)->format('d/m/Y') }}
                            </td>
                            
                            {{-- CORRECCIÓN: Formatear un poco mejor el resultado --}}
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 font-bold">
                                @if($partit->resultat)
                                    {{ $partit->resultat }}
                                @else
                                    <span class="text-gray-500 text-xs">PENDENT</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="text-center py-4 px-6 text-gray-500">No hi ha partits programats.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection