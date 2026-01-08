<?php

namespace App\Http\Controllers;

use App\Models\Equip; // Necessari per al formulari
use App\Models\Jugadora;
use App\Repositories\JugadoraRepository;
use App\Services\JugadoraService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class JugadoraController extends Controller
{
    protected $jugadoraService;
    protected $jugadoraRepository;

    // Definim les posicions per al formulari <select>
    protected $posicions = ['Portera', 'Defensa', 'Migcampista', 'Davantera'];

    public function __construct(JugadoraService $jugadoraService, JugadoraRepository $jugadoraRepository)
    {
        $this->jugadoraService = $jugadoraService;
        $this->jugadoraRepository = $jugadoraRepository;
    }

    /**
     * Mostra la llista de jugadores (ja implementat).
     */
    public function index()
    {
        $jugadores = $this->jugadoraRepository->getAll();
        return view('jugadores.index', compact('jugadores'));
    }

    /**
     * Mostra el formulari de creació.
     */
    public function create()
    {
        $equips = Equip::all(); // Obtenim equips per al <select>
        return view('jugadores.create', [
            'posicions' => $this->posicions,
            'equips' => $equips
        ]);
    }

    /**
     * Guarda la nova jugadora.
     */
    public function store(Request $request)
    {
        try {
            $this->jugadoraService->createJugadora($request->all());
            return redirect()->route('jugadores.index')->with('success', 'Jugadora creada correctament.');
        } catch (ValidationException $e) {
            return redirect()->route('jugadores.create')
                ->withErrors($e->validator)
                ->withInput();
        }
    }

    /**
     * Mostra el formulari per editar.
     */
    public function edit(Jugadora $jugadora) // Route Model Binding
    {
        $equips = Equip::all();
        return view('jugadores.edit', [
            'jugadora' => $jugadora,
            'posicions' => $this->posicions,
            'equips' => $equips
        ]);
    }

    /**
     * Actualitza una jugadora existent.
     */
    public function update(Request $request, Jugadora $jugadora)
    {
        try {
            $this->jugadoraService->updateJugadora($jugadora->id, $request->all());
            return redirect()->route('jugadores.index')->with('success', 'Jugadora actualitzada correctament.');
        } catch (ValidationException $e) {
            return redirect()->route('jugadores.edit', $jugadora->id)
                ->withErrors($e->validator)
                ->withInput();
        }
    }

    /**
     * Esborra una jugadora.
     */
    public function destroy(Jugadora $jugadora)
    {
        $this->jugadoraRepository->delete($jugadora->id);
        return redirect()->route('jugadores.index')->with('success', 'Jugadora esborrada correctament.');
    }
}