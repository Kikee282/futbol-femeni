@extends('layouts.equip')
@section('title', 'Llistat de Partits')

@section('content')
    <h2 class="text-2xl font-bold mb-6">Llistat de Partits ⚽📅</h2>

    {{-- 
        ELIMINAMOS EL BOTÓN DE CREAR PORQUE YA NO ESTÁ PERMITIDO MANUALMENTE
    --}}

    {{-- Missatge d'èxit --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-200 text-gray-700 uppercase text-sm leading-normal">
                    <th class="py-3 px-6">Data</th>
                    <th class="py-3 px-6 text-center">Local</th>
                    <th class="py-3 px-6 text-center">Visitant</th>
                    <th class="py-3 px-6 text-center">Resultat</th>
                    <th class="py-3 px-6 text-center">Accions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach ($partits as $partit)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        {{-- 1. Formateamos la fecha para que se vea bonita (día/mes/año) --}}
                        <td class="py-3 px-6">
                            {{ \Carbon\Carbon::parse($partit->data)->format('d/m/Y') }}
                        </td>

                        <td class="py-3 px-6 text-center font-medium">{{ $partit->local->nom }}</td>
                        <td class="py-3 px-6 text-center font-medium">{{ $partit->visitant->nom }}</td>

                        {{-- 2. CORRECCIÓN PRINCIPAL: Accedemos al JSON de goles correctamente --}}
                        <td class="py-3 px-6 text-center font-bold text-lg">
                            @if(is_array($partit->gols) && isset($partit->gols['local']) && isset($partit->gols['visitant']))
                                {{ $partit->gols['local'] }} - {{ $partit->gols['visitant'] }}
                            @else
                                <span class="text-gray-400 text-xs italic">PENDENT</span>
                            @endif
                        </td>

                        <td class="py-3 px-6 text-center">
                            <a href="{{ route('partits.show', $partit->id) }}" class="text-blue-500 hover:text-blue-700 mr-2">
                                Veure
                            </a>
                            
                            {{-- Solo mostramos editar si el usuario tiene permiso --}}
                            @auth
                                <a href="{{ route('partits.edit', $partit->id) }}" class="text-yellow-500 hover:text-yellow-700 font-bold ml-2">
                                    ✐ Editar
                                </a>
                            @endauth
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $partits->links() }}
    </div>
@endsection