<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EquipController extends Controller
{
    /**
     * Dades inicials (seed) per als equips.
     */
    private function getEquipsData()
    {
        return [
            ['id' => 1, 'nom' => 'Barça Femení', 'ciutat' => 'Barcelona', 'entrenador' => 'Jonatan Giráldez'],
            ['id' => 2, 'nom' => 'Atlètic de Madrid', 'ciutat' => 'Madrid', 'entrenador' => 'Manolo Cano'],
            ['id' => 3, 'nom' => 'Real Madrid Femení', 'ciutat' => 'Madrid', 'entrenador' => 'Alberto Toril'],
        ];
    }

    /**
     * Mostra el llistat d'equips.
     */
    public function index()
    {
        // Obtenir equips de la sessió. Si no n'hi ha, utilitzar les dades inicials.
        $equips = session()->get('equips');

        if (is_null($equips)) {
            $equips = $this->getEquipsData();
            session()->put('equips', $equips);
        }

        return view('equips.index', compact('equips'));
    }

    /**
     * Mostra el formulari per crear un nou equip.
     */
    public function create()
    {
        // Aquesta vista ja la tenies creada
        return view('equips.create');
    }

    /**
     * Emmagatzema un nou equip a la sessió.
     */
    public function store(Request $request)
    {
        // Validació (pots afegir les regles que consideris)
        $validated = $request->validate([
            'nom' => 'required|string|min:3',
            'ciutat' => 'required|string|min:2',
            'entrenador' => 'required|string|min:3',
        ]);

        // Obtenir equips de la sessió (o les dades inicials si està buida)
        $equips = session()->get('equips', $this->getEquipsData());

        // Generar un nou ID
        $newId = count($equips) > 0 ? max(array_column($equips, 'id')) + 1 : 1;
        
        $newEquip = [
            'id' => $newId,
            'nom' => $validated['nom'],
            'ciutat' => $validated['ciutat'],
            'entrenador' => $validated['entrenador'],
        ];

        // Afegir el nou equip i guardar a la sessió
        $equips[] = $newEquip;
        session()->put('equips', $equips);

        // Redirigir al llistat amb missatge d'èxit
        return redirect()->route('equips.index')->with('success', 'Equip creat correctament.');
    }

    /**
     * Mostra un equip específic (opcional, ja que no es demanava a la pràctica).
     * Si no la fas servir, pots esborrar la ruta 'equips.show'.
     */
    public function show(string $id)
    {
        $equips = session()->get('equips', $this->getEquipsData());
        $equip = collect($equips)->firstWhere('id', '==', $id);

        if (!$equip) {
            abort(404, 'Equip no trobat');
        }

        // Aquesta vista ja la tenies creada
        return view('equips.show', compact('equip'));
    }
}