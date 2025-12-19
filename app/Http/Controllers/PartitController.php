<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PartitController extends Controller
{
    protected $initialPartits = [
        [
            'id' => 1,
            'local' => 'FC Barcelona Femení',
            'visitant' => 'Real Madrid Femení',
            'data' => '2025-10-15',
            'resultat' => '3-1',
        ],
        [
            'id' => 2,
            'local' => 'Atlètic de Madrid Femení',
            'visitant' => 'FC Barcelona Femení',
            'data' => '2025-10-22',
            'resultat' => null, // Partit pendent
        ],
    ];

    /**
     * Obté els partits de la sessió o els inicialitza amb el SEED.
     */
    protected function getPartits()
    {
        if (!session()->has('partits')) {
            session(['partits' => $this->initialPartits]);
        }
        return session('partits');
    }

    /**
     * Mètode INDEX: Mostra la llista de partits.
     * Ruta: GET /partits
     */
    public function index()
    {
        $partits = $this->getPartits();
        
        return view('partits.index', compact('partits'));
    }

    /**
     * Mètode CREATE: Mostra el formulari.
     * Ruta: GET /partits/crear
     */
    public function create()
    {
        return view('partits.create');
    }

    /**
     * Mètode STORE: Guarda el nou partit a la sessió.
     * Ruta: POST /partits
     */
    public function store(Request $request)
    {
        // 1. Validació estricta (amb missatge personalitzat per al regex)
        $request->validate([
            'local' => 'required|min:2|max:150',
            'visitant' => 'required|min:2|max:150|different:local',
            'data' => 'required|date_format:Y-m-d',
            // El regex accepta només X-Y on X i Y són dígits (p. ex., 2-1, 0-0)
            'resultat' => 'nullable|regex:/^\d+-\d+$/', 
        ], [
            // Missatge d'error personalitzat per al regex del resultat
            'resultat.regex' => 'El format del resultat no és vàlid. Ha de ser "GolsLocal-GolsVisitant" (ex. 2-1).',
            'visitant.different' => 'L\'equip visitant ha de ser diferent de l\'equip local.',
        ]);
        
        // 2. Obtenció i Preparació de Dades
        $partits = $this->getPartits();
        $newId = $partits ? max(array_column($partits, 'id')) + 1 : 1;

        $nouPartit = $request->only(['local', 'visitant', 'data', 'resultat']);
        $nouPartit['id'] = $newId;
        
        // El camp 'resultat' pot ser null si l'usuari el deixa buit (partit pendent)
        
        // 3. Guardar en Sessió
        $partits[] = $nouPartit;
        session(['partits' => $partits]);

        // 4. Redirigir
        return redirect()
            ->route('partits.index')
            ->with('success', 'Partit creat correctament. Data: ' . $nouPartit['data']);
    }
}