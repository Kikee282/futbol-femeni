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
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">Nom</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">Equip</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">Posició</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @if (isset($jugadores) && count($jugadores) > 0)
                    {{-- Iterem i utilitzem el Component Blade --}}
                    @foreach ($jugadores as $jugadora)
                        <x-jugadora-row :jugadora="$jugadora"/>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3" class="text-center py-4 px-6 text-gray-500">No hi ha jugadores registrades.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection