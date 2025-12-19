<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JugadoraController extends Controller
{
    protected $posicions = [
        'Portera',
        'Defensa',
        'Migcampista',
        'Davantera'
    ];
    
    // Dades inicials per a la sessió (SEED) - Opcional, pots deixar-ho buit
    protected $initialJugadores = [
        [
            'nom' => 'Alexia Putellas',
            'equip' => 'FC Barcelona Femení',
            'posicio' => 'Migcampista'
        ],
        [
            'nom' => 'Misa Rodríguez',
            'equip' => 'Real Madrid Femení',
            'posicio' => 'Portera'
        ],
        [
            'nom' => 'Esther González',
            'equip' => 'Atlètic de Madrid',
            'posicio' => 'Davantera'
        ],
    ];

    /**
     * Mètode privat per obtenir les jugadores de la sessió.
     * Si no existeixen, les inicialitza.
     */
    protected function getJugadores()
    {
        // Si no existeix la clau 'jugadores', la creem (amb dades inicials o buida)
        if (!session()->has('jugadores')) {
            // Pots canviar $this->initialJugadores per [] si vols començar buit
            session(['jugadores' => $this->initialJugadores]); 
        }
        
        // Retornem les dades de la sessió.
        return session('jugadores');
    }

    /**
     * Mètode INDEX: Mostra la llista de jugadores.
     * Ruta: GET /jugadores
     */
    public function index()
    {
        $jugadores = $this->getJugadores();
        
        return view('jugadores.index', compact('jugadores'));
    }

    /**
     * Mètode CREATE: Mostra el formulari per crear.
     * Ruta: GET /jugadores/crear
     */
    public function create()
    {
        // Passem la llista de posicions a la vista per al <select>
        return view('jugadores.create', [
            'posicions' => $this->posicions
        ]);
    }

    /**
     * Mètode STORE: Guarda la nova jugadora a la sessió.
     * Ruta: POST /jugadores
     */
    public function store(Request $request)
    {
        // 1. Validació (segons l'enunciat)
        $request->validate([
            'nom' => 'required|min:3|max:150',
            'equip' => 'required|min:2|max:150',
            // Usem Rule::in per validar contra la nostra llista de posicions
            'posicio' => ['required', Rule::in($this->posicions)], 
        ]);
        
        // 2. Obtenim les dades actuals de la sessió
        $jugadores = $this->getJugadores();
        
        // 3. Calculem el nou ID
        $newId = $jugadores ? max(array_column($jugadores, 'id')) + 1 : 1;

        // 4. Creem la nova jugadora amb les dades del formulari
        $novaJugadora = $request->only(['nom', 'equip', 'posicio']);
        $novaJugadora['id'] = $newId;

        // 5. Afegim la nova jugadora a l'array
        $jugadores[] = $novaJugadora;
        
        // 6. Guardem l'array actualitzat a la sessió
        session(['jugadores' => $jugadores]);

        // 7. Redirigim a la llista amb un missatge d'èxit
        return redirect()
            ->route('jugadores.index')
            ->with('success', 'Jugadora "' . $novaJugadora['nom'] . '" afegida correctament!');
    }
}