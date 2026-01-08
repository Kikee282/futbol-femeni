@props(['name', 'label', 'estadis', 'selected' => null])

<div class="mb-4">
    <label for="{{ $name }}" class="block text-gray-700 font-bold mb-2">{{ $label }}</label>
    <select name="{{ $name }}" id="{{ $name }}" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        <option value="">-- Selecciona un estadi --</option>
        @foreach ($estadis as $estadi)
            <option value="{{ $estadi->id }}" {{ $selected == $estadi->id ? 'selected' : '' }}>
                {{ $estadi->nom }} (Cap: {{ $estadi->capacitat }})
            </option>
        @endforeach
    </select>
    @error($name)
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
    @enderror
</div>