@extends('layouts.app')

@section('title', 'Llistat d\'Estadis')

@section('content')
    <h2>Llistat d'Estadis 🏟️</h2>

    <p><a href="{{ route('estadis.create') }}" class="button-link">+ Nou Estadi</a></p>

    {{-- Missatge d'èxit (Flash Session) --}}
    @if (session('success'))
        <div class="alert success-alert">
            {{ session('success') }}
        </div>
    @endif
    
    {{-- Estils bàsics per a la taula i els missatges (pots moure'ls a guias.css) --}}
    <style>
        .alert { padding: 10px; margin-bottom: 15px; border-radius: 5px; }
        .success-alert { color: #155724; background-color: #d4edda; border: 1px solid #c3e6cb; }
        .button-link { background-color: #007bff; color: white; padding: 8px 15px; text-decoration: none; border-radius: 5px; display: inline-block; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; box-shadow: 0 2px 5px rgba(0,0,0,0.1); background-color: white; }
        th, td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f8f9fa; color: #343a40; }
        tr:hover { background-color: #f1f1f1; }
        .no-records { text-align: center; color: #6c757d; padding: 20px; }
    </style>

    @if (count($estadis) > 0)
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Ciutat</th>
                    <th>Capacitat</th>
                    <th>Equip Principal</th>
                </tr>
            </thead>
            <tbody>
                {{-- Iterem i utilitzem el Component Blade --}}
                @foreach ($estadis as $estadi)
                    <x-estadi-card :estadi="$estadi"/>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="no-records">No hi ha estadis registrats.</p>
    @endif
@endsection