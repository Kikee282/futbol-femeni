@extends('layouts.app') {{-- CORREGIT: Era 'layout.app' i ha de ser 'layouts.app' --}}

@section('title', 'Llistat d\'Equips')

@section('content')
    <h2 class="text-2xl font-bold mb-6">Llistat d'Equips ⚽</h2>

    {{-- Missatge d'èxit (Flash Session) --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <p class="mb-4">
        {{-- Aquest enllaç ara funciona gràcies al fitxer de rutes --}}
        <a href="{{ route('equips.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Nou Equip
        </a>
    </p>

    <div class="bg-white shadow-md rounded my-6">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">Nom</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">Estadi</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs leading-4 font-medium text-gray-600 uppercase tracking-wider">Títols</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                {{-- Comprovem si l'array $equips existeix i no és buit --}}
                @if (isset($equips) && count($equips) > 0)
                    @foreach ($equips as $equip)
                        <tr class="hover:bg-gray-100">
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $equip['nom'] }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $equip['estadi'] }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $equip['titols'] }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="text-center py-4 px-6 text-gray-500">No hi ha equips registrats.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection