@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Nova Jugadora</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Hi ha errors al formulari:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('jugadores.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom') }}">
            </div>

            <div class="mb-3">
                <label for="equip" class="form-label">Equip</label>
                <input type="text" class="form-control" id="equip" name="equip" value="{{ old('equip') }}">
            </div>

            <div class="mb-3">
                <label for="posicio" class="form-label">Posició</label>
                <select class="form-select" id="posicio" name="posicio">
                    <option value="" disabled {{ old('posicio') ? '' : 'selected' }}>Selecciona una posició</option>
                    @foreach ($posicions as $posicio)
                        <option value="{{ $posicio }}" {{ old('posicio') == $posicio ? 'selected' : '' }}>
                            {{ $posicio }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('jugadores.index') }}" class="btn btn-secondary">Cancel·lar</a>
        </form>
    </div>
@endsection