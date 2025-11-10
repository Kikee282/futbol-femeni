<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JugadoresController extends Controller
{
    private function getJugadoresData()
    {
        return [
            ['id' => 1, 'nom' => 'Alexia Putellas', 'equip' => 'Barça Femení', 'posicio' => 'Migcampista'],
            ['id' => 2, 'nom' => 'Esther González', 'equip' => 'Atlètic de Madrid', 'posicio' => 'Davantera'],
            ['id' => 3, 'nom' => 'Misa Rodríguez', 'equip' => 'Real Madrid Femení', 'posicio' => 'Portera'],
        ];
    }

    public function index()
    {
        $jugadores = session()->get('jugadores');
        if (is_null($jugadores)) {
            $jugadores = $this->getJugadoresData();
            session()->put('jugadores', $jugadores);
        }
        return view('jugadores.index', compact('jugadores'));
    }

    public function create()
    {
        $posicions = ['Portera', 'Defensa', 'Migcampista', 'Davantera'];
        return view('jugadores.create', compact('posicions'));
    }

    public function store(Request $request)
    {
        $posicionsValides = ['Portera', 'Defensa', 'Migcampista', 'Davantera'];

        $validated = $request->validate([
            'nom' => 'required|string|min:3',
            'equip' => 'required|string|min:2',
            'posicio' => ['required', Rule::in($posicionsValides)],
        ]);

        $jugadores = session()->get('jugadores', $this->getJugadoresData());

        $newId = count($jugadores) > 0 ? max(array_column($jugadores, 'id')) + 1 : 1;
        
        $newJugadora = [
            'id' => $newId,
            'nom' => $validated['nom'],
            'equip' => $validated['equip'],
            'posicio' => $validated['posicio'],
        ];

        $jugadores[] = $newJugadora;
        session()->put('jugadores', $jugadores);

        return redirect()->route('jugadores.index')->with('success', 'Jugadora creada correctament.');
    }
}