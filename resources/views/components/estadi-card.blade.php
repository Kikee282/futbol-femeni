@props(['estadi'])

{{-- Aquest component representa una única fila (<tr>) de la taula --}}
<tr>
    <td>{{ $estadi['nom'] }}</td>
    <td>{{ $estadi['ciutat'] }}</td>
    {{-- Formategem el número de capacitat --}}
    <td>{{ number_format($estadi['capacitat'], 0, '.', ',') }}</td>
    <td>{{ $estadi['equip_principal'] }}</td>
</tr>