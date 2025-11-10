@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Llistat de Jugadores</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('jugadores.create') }}" class="btn btn-primary mb-3">+ Nova Jugadora</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Equip</th>
                    <th>Posició</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($jugadores as $jugadora)
                    <x-jugadora :jugadora="$jugadora" />
                @empty
                    <tr>
                        <td colspan="3">No hi ha jugadores per mostrar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection