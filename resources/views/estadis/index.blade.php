@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Llistat d'Estadis</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('estadis.create') }}" class="btn btn-primary mb-3">+ Nou Estadi</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Ciutat</th>
                    <th>Capacitat</th>
                    <th>Equip Principal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($estadis as $estadi)
                    <x-estadi :estadi="$estadi" />
                @empty
                    <tr>
                        <td colspan="4">No hi ha estadis per mostrar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection