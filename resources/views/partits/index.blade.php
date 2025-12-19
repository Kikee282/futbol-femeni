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
            <tbody class="bg-white">
                @if (isset($partits) && count($partits) > 0)
                    @foreach ($partits as $partit)
                        <tr class="hover:bg-gray-100">
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <x-equip-mini :nom="$partit['local']"/>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <x-equip-mini :nom="$partit['visitant']"/>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm">
                                {{ $partit['data'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 font-bold">
                                {{ $partit['resultat'] ?? 'PENDENT' }}
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