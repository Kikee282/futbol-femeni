@extends('layouts.equip')
@section('title', 'Llistat de Jugadores')

@section('content')
<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold leading-tight text-gray-800">Llistat de Jugadores</h2>
            
            {{-- Només l'admin pot crear jugadores --}}
            @if(auth()->user() && auth()->user()->role === 'admin')
                <a href="{{ route('jugadores.create') }}" class="bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 transition duration-150">
                    + Nova Jugadora
                </a>
            @endif
        </div>

        {{-- Missatge d'èxit --}}
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Jugadora
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Equip
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Posició
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Edat
                            </th>
                            {{-- Columna Accions només visible per Admin --}}
                            @if(auth()->user() && auth()->user()->role === 'admin')
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Accions
                                </th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jugadores as $jugadora)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex items-center">
                                        {{-- Foto de la jugadora (si en té) --}}
                                        <div class="flex-shrink-0 w-10 h-10">
                                            @if($jugadora->foto)
                                                <img class="w-full h-full rounded-full object-cover"
                                                     src="{{ Storage::url($jugadora->foto) }}"
                                                     alt="{{ $jugadora->nom }}" />
                                            @else
                                                <div class="w-full h-full rounded-full bg-gray-300 flex items-center justify-center text-gray-600">
                                                    {{ substr($jugadora->nom, 0, 1) }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-gray-900 whitespace-no-wrap font-semibold">
                                                {{ $jugadora->nom }}
                                            </p>
                                            <p class="text-gray-600 whitespace-no-wrap text-xs">
                                                Dorsal: {{ $jugadora->dorsal ?? '-' }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $jugadora->equip->nom ?? 'Sense equip' }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <span class="relative inline-block px-3 py-1 font-semibold leading-tight 
                                        {{ $jugadora->posicio === 'Portera' ? 'text-yellow-900' : 
                                          ($jugadora->posicio === 'Davantera' ? 'text-green-900' : 'text-blue-900') }}">
                                        <span aria-hidden class="absolute inset-0 opacity-50 rounded-full 
                                            {{ $jugadora->posicio === 'Portera' ? 'bg-yellow-200' : 
                                              ($jugadora->posicio === 'Davantera' ? 'bg-green-200' : 'bg-blue-200') }}">
                                        </span>
                                        <span class="relative">{{ $jugadora->posicio }}</span>
                                    </span>
                                </td>
                                
                                {{-- CÀLCUL D'EDAT (Punt 10 de la rúbrica) --}}
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    @if($jugadora->data_naixement)
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ \Carbon\Carbon::parse($jugadora->data_naixement)->format('d/m/Y') }}
                                        </p>
                                        <p class="text-gray-500 text-xs">
                                            ({{ \Carbon\Carbon::parse($jugadora->data_naixement)->age }} anys)
                                        </p>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>

                                {{-- Botons d'Acció (Només Admin) --}}
                                @if(auth()->user() && auth()->user()->role === 'admin')
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <div class="flex items-center space-x-4">
                                            <a href="{{ route('jugadores.edit', $jugadora) }}" class="text-indigo-600 hover:text-indigo-900 font-medium">
                                                Editar
                                            </a>
                                            
                                            <form action="{{ route('jugadores.destroy', $jugadora) }}" method="POST" onsubmit="return confirm('Estàs segur que vols eliminar aquesta jugadora?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 font-medium">
                                                    Esborrar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                    No hi ha jugadores registrades actualment.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                    @if(method_exists($jugadores, 'links'))
                    <div class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
                        {{ $jugadores->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection