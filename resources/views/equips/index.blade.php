@extends('layouts.equip')
@section('title', "Guia d'Equips")

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-blue-800">Guia d'Equips</h1>
        <a href="{{ route('equips.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            + Nou equip
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full border-collapse border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border-b border-gray-200 p-3 text-left text-sm font-semibold text-gray-600">Nom</th>
                    <th class="border-b border-gray-200 p-3 text-left text-sm font-semibold text-gray-600">Estadi</th>
                    <th class="border-b border-gray-200 p-3 text-center text-sm font-semibold text-gray-600">Títols</th>
                    {{-- NOVA COLUMNA --}}
                    <th class="border-b border-gray-200 p-3 text-center text-sm font-semibold text-gray-600">Forma</th>
                    <th class="border-b border-gray-200 p-3 text-center text-sm font-semibold text-gray-600">Accions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($equips as $equip)
                    <tr class="hover:bg-gray-50 border-b border-gray-200">
                        {{-- COLUMNA NOM (Amb Escut) --}}
                        <td class="p-3 flex items-center space-x-3">
                            @if($equip->escut)
                                <img src="{{ asset('storage/' . $equip->escut) }}" alt="Escut" class="h-10 w-10 object-contain rounded-full border border-gray-300">
                            @else
                                <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 text-xs">
                                    N/A
                                </div>
                            @endif
                            <a href="{{ route('equips.show', $equip->id) }}" class="text-blue-700 font-medium hover:underline">
                                {{ $equip->nom }}
                            </a>
                        </td>

                        {{-- COLUMNA ESTADI --}}
                        <td class="p-3 text-gray-700">
                            {{ $equip->estadi->nom ?? 'Sense Estadi' }}
                        </td>

                        {{-- COLUMNA TÍTOLS --}}
                        <td class="p-3 text-center text-gray-700">
                            {{ $equip->titols ?? 0 }}
                        </td>

                        {{-- NOVA COLUMNA: ÚLTIMS RESULTATS --}}
                        <td class="p-3 text-center">
                            <div class="flex justify-center items-center space-x-1">
                                @if(count($equip->ultims_resultats) > 0)
                                    @foreach($equip->ultims_resultats as $res)
                                        <span class="text-lg cursor-help" title="{{ $res == '✅' ? 'Guanyat' : ($res == '➖' ? 'Empatat' : 'Perdut') }}">
                                            {{ $res }}
                                        </span>
                                    @endforeach
                                @else
                                    <span class="text-gray-400 text-xs">- Sense dades -</span>
                                @endif
                            </div>
                        </td>

                        {{-- COLUMNA ACCIONS --}}
                        <td class="p-3 text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('equips.edit', $equip->id) }}" class="text-yellow-600 hover:text-yellow-800">
                                    editar
                                </a>
                                {{-- Només Admin pot esborrar --}}
                                @if(auth()->user() && auth()->user()->role === 'admin')
                                    <form action="{{ route('equips.destroy', $equip->id) }}" method="POST" onsubmit="return confirm('Segur?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">
                                            borrar
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        {{-- Paginació (si en tens) --}}
        <div class="p-4">
            {{ $equips->links() }}
        </div>
    </div>
@endsection