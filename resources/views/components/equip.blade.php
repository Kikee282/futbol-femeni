<div class="equip border rounded-lg shadow-md p-4 bg-white">
    @if ($equip->escut)
        <td class="border border-gray-300 p-2">
            <img src="{{ asset('storage/' . $equip->escut) }}" alt="Escut de {{ $equip->nom }}" class="h-8 w-8 object-cover rounded-full">
        </td>
    @endif
    <h2 class="text-xl font-bold text-blue-800">{{ $equip->nom }}</h2>
    <p><strong>Estadi:</strong> {{ $equip->estadi->nom }}</p>
    <p><strong>Títols:</strong> {{ $equip->titols }}</p>
</div>