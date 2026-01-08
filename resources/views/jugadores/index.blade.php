@extends('layouts.app')

@section('title', 'Llistat de Jugadores')

@section('content')
    <h2 class="text-2xl font-bold mb-6">Llistat de Jugadores 👩‍</h2>

    <p class="mb-4">
        <a href="{{ route('jugadores.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Nova Jugadora
        </a>
    </p>

    {{-- Missatge d'èxit (Flash Session) --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="bg-white shadow-md rounded my-6">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-200">
    <tr>
        <th class="px-6 ...">Nom</th>
        <th class="px-6 ...">Equip</th>
        <th class="px-6 ...">Posició</th>
        <th class="px-6 ...">Accions</th> {{-- NOVA COLUMNA --}}
    </tr>
</thead>
<tbody class="bg-white">
    @if (isset($jugadores) && count($jugadores) > 0)
        @foreach ($jugadores as $jugadora)
            {{-- El component <x-jugadora-row> ja no és necessari si fem això --}}
            <tr class="hover:bg-gray-100">
                <td class="px-6 ...">{{ $jugadora->nom }}</td>
                <td class="px-6 ...">{{ $jugadora->equip->nom ?? 'Sense equip' }}</td>
                <td class="px-6 ...">{{ $jugadora->posicio }}</td>
                {{-- NOVES ACCIONS --}}
                <td class="px-6 py-4 ...">
                    <a href="{{ route('jugadores.edit', $jugadora) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                    <form action="{{ route('jugadores.destroy', $jugadora) }}" method="POST" class="inline-block ml-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Estàs segur?')">Esborrar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    @else
        [...]
    @endif
</tbody>
        </table>
    </div>
@endsection