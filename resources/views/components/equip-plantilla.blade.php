@props(['jugadores'])

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @forelse ($jugadores as $jugadora)
        <div class="bg-white border rounded shadow p-4 flex items-center space-x-4">
            {{-- Avatar por defecto si no hay foto --}}
            <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold">
                {{ substr($jugadora->nom, 0, 1) }}
            </div>
            <div>
                <p class="font-bold text-gray-800">{{ $jugadora->nom }}</p>
                <p class="text-sm text-gray-500">{{ $jugadora->posicio }} - Dorsal: {{ $jugadora->dorsal ?? '?' }}</p>
            </div>
        </div>
    @empty
        <p class="text-gray-500 col-span-3">No hi ha jugadores registrades.</p>
    @endforelse
</div>