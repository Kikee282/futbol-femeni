@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Llistat de Partits</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('partits.create') }}" class="btn btn-primary mb-3">+ Nou Partit</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Local</th>
                    <th>Visitant</th>
                    <th>Data</th>
                    <th>Resultat</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($partits as $partit)
                    <tr>
                        <td><x-equip-mini :nom="$partit['local']" /></td>
                        <td><x-equip-mini :nom="$partit['visitant']" /></td>
                        <td>{{ \Carbon\Carbon::parse($partit['data'])->format('d/m/Y') }}</td>
                        <td>{{ $partit['resultat'] ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No hi ha partits per mostrar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection