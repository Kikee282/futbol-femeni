@props(['jugadora'])

{{-- Aquest component representa una única fila (<tr>) de la taula --}}
<tr class="hover:bg-gray-100">
    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
        {{ $jugadora['nom'] }}
    </td>
    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
        {{ $jugadora['equip'] }}
    </td>
    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
        {{ $jugadora['posicio'] }}
    </td>
</tr>