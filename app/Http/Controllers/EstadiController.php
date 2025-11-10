<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EstadiController extends Controller
{
    private function getEstadisData()
    {
        return [
            ['id' => 1, 'nom' => 'Estadi Johan Cruyff', 'ciutat' => 'Sant Joan Despí', 'capacitat' => 6000, 'equip_principal' => 'FC Barcelona Femení'],
            ['id' => 2, 'nom' => 'Centro Deportivo Wanda Alcalá de Henares', 'ciutat' => 'Alcalá de Henares', 'capacitat' => 2800, 'equip_principal' => 'Atlètic de Madrid Femení'],
            ['id' => 3, 'nom' => 'Estadio Alfredo Di Stéfano', 'ciutat' => 'Madrid', 'capacitat' => 6000, 'equip_principal' => 'Real Madrid Femení'],
        ];
    }

    public function index()
    {
        $estadis = session()->get('estadis');

        if (is_null($estadis)) {
            $estadis = $this->getEstadisData();
            session()->put('estadis', $estadis);
        }

        return view('estadis.index', compact('estadis'));
    }

    public function create()
    {
        return view('estadis.create');
    }

    public function store(Request $request)
    {
        // Validació dels camps
        $validated = $request->validate([
            'nom' => 'required|string|min:3',
            'ciutat' => 'required|string|min:2',
            'capacitat' => 'required|integer|min:0',
            'equip_principal' => 'required|string|min:3',
        ]);

        $estadis = session()->get('estadis', $this->getEstadisData());

        $newId = count($estadis) > 0 ? max(array_column($estadis, 'id')) + 1 : 1;
        
        $newEstadi = [
            'id' => $newId,
            'nom' => $validated['nom'],
            'ciutat' => $validated['ciutat'],
            'capacitat' => $validated['capacitat'],
            'equip_principal' => $validated['equip_principal'],
        ];

        $estadis[] = $newEstadi;
        session()->put('estadis', $estadis);

        return redirect()->route('estadis.index')->with('success', 'Estadi creat correctament.');
    }
}