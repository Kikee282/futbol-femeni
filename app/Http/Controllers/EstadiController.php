<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EstadiController extends Controller
{
protected $initialEstadis = [
        [
            'id' => 1,
            'nom' => 'Estadi Johan Cruyff',
            'ciutat' => 'Sant Joan Despí',
            'capacitat' => 6000,
            'equip_principal' => 'FC Barcelona Femení'
        ],
        [
            'id' => 2,
            'nom' => 'Centro Deportivo Wanda Alcalá de Henares',
            'ciutat' => 'Alcalá de Henares',
            'capacitat' => 2800,
            'equip_principal' => 'Atlètic de Madrid Femení'
        ],
        [
            'id' => 3,
            'nom' => 'Estadio Alfredo Di Stéfano',
            'ciutat' => 'Madrid',
            'capacitat' => 6000,
            'equip_principal' => 'Real Madrid Femení'
        ],
    ];

    /**
     * Mètode privat per obtenir els estadis de la sessió.
     * Si no existeixen, els inicialitza amb el 'seed'.
     */
    protected function getEstadis()
    {
        // Comprovem si la clau 'estadis' existeix a la sessió.
        // Si no existeix, la creem amb les dades inicials (seed).
        if (!session()->has('estadis')) {
            session(['estadis' => $this->initialEstadis]);
        }
        
        // Retornem les dades de la sessió.
        return session('estadis');
    }

    /**
     * Mètode INDEX: Mostra la llista d'estadis.
     * Ruta: GET /estadis
     */
    public function index()
    {
        $estadis = $this->getEstadis();
        
        return view('estadis.index', compact('estadis'));
    }

    /**
     * Mètode CREATE: Mostra el formulari per crear.
     * Ruta: GET /estadis/crear
     */
    public function create()
    {
        return view('estadis.create');
    }

    /**
     * Mètode STORE: Guarda el nou estadi a la sessió.
     * Ruta: POST /estadis
     */
    public function store(Request $request)
    {
        // 1. Validació obligatòria (segons l'enunciat)
        $request->validate([
            'nom' => 'required|min:3|max:150',
            'ciutat' => 'required|min:2|max:100',
            'capacitat' => 'required|integer|min:0', 
            'equip_principal' => 'required|min:3|max:150',
        ]);
        
        // 2. Obtenim les dades actuals de la sessió
        $estadis = $this->getEstadis();
        
        // 3. Calculem el nou ID (ID màxim actual + 1)
        // Si l'array és buit, comencem per 1.
        $newId = $estadis ? max(array_column($estadis, 'id')) + 1 : 1;

        // 4. Creem el nou estadi amb les dades del formulari
        $nouEstadi = $request->only(['nom', 'ciutat', 'capacitat', 'equip_principal']);
        $nouEstadi['id'] = $newId;
        $nouEstadi['capacitat'] = (int) $nouEstadi['capacitat']; // Assegurem que és integer

        // 5. Afegim el nou estadi a l'array
        $estadis[] = $nouEstadi;
        
        // 6. Guardem l'array actualitzat a la sessió
        session(['estadis' => $estadis]);

        // 7. Redirigim a la llista amb un missatge d'èxit
        return redirect()
            ->route('estadis.index')
            ->with('success', 'Estadi "' . $nouEstadi['nom'] . '" afegit correctament!');
    }
}