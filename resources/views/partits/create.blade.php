@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Nou Partit</h1>

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

        <form action="{{ route('partits.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="local" class="form-label">Equip Local</label>
                    <input type="text" class="form-control" id="local" name="local" value="{{ old('local') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="visitant" class="form-label">Equip Visitant</label>
                    <input type="text" class="form-control" id="visitant" name="visitant" value="{{ old('visitant') }}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="data" class="form-label">Data</label>
                    <input type="date" class="form-control" id="data" name="data" value="{{ old('data') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="resultat" class="form-label">Resultat (Opcional, ex. 2-1)</label>
                    <input type="text" class="form-control" id="resultat" name="resultat" value="{{ old('resultat') }}" placeholder="Ex. 3-0">
                </div>
            </div>

            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('partits.index') }}" class="btn btn-secondary">Cancel·lar</a>
        </form>
    </div>
@endsection