@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Nou Estadi</h1>

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

        <form action="{{ route('estadis.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom') }}">
            </div>

            <div class="mb-3">
                <label for="ciutat" class="form-label">Ciutat</label>
                <input type="text" class="form-control" id="ciutat" name="ciutat" value="{{ old('ciutat') }}">
            </div>

            <div class="mb-3">
                <label for="capacitat" class="form-label">Capacitat</label>
                <input type="number" class="form-control" id="capacitat" name="capacitat" value="{{ old('capacitat') }}">
            </div>

            <div class="mb-3">
                <label for="equip_principal" class="form-label">Equip Principal</label>
                <input type="text" class="form-control" id="equip_principal" name="equip_principal" value="{{ old('equip_principal') }}">
            </div>

            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('estadis.index') }}" class="btn btn-secondary">Cancel·lar</a>
        </form>
    </div>
@endsection