<?php

namespace App\Http\Controllers;

use App\Services\JugadoraService;
use App\Services\EquipService; // Necessari per al desplegable d'equips al crear/editar
use Illuminate\Http\Request;
// use App\Http\Requests\StoreJugadoraRequest; // Descomentar quan el creïs
// use App\Http\Requests\UpdateJugadoraRequest; // Descomentar quan el creïs

class JugadoresController extends Controller
{
    protected $jugadoraService;
    protected $equipService;

    public function __construct(JugadoraService $jugadoraService, EquipService $equipService)
    {
        $this->jugadoraService = $jugadoraService;
        $this->equipService = $equipService;
    }

    public function index()
    {
        $jugadores = $this->jugadoraService->getAll();
        return view('jugadores.index', compact('jugadores'));
    }

    public function create()
    {
        // Necessitem els equips per al <select> del formulari
        $equips = $this->equipService->llistar();
        return view('jugadores.create', compact('equips'));
    }

    public function store(Request $request) // Canviar a StoreJugadoraRequest més endavant
    {
        // Validació ràpida (idealment moure a FormRequest)
        $data = $request->validate([
            'nom' => 'required|string',
            'cognoms' => 'required|string',
            'dorsal' => 'required|integer',
            'equip_id' => 'required|exists:equips,id',
            'data_naixement' => 'required|date',
            'foto' => 'nullable|image'
        ]);

        $this->jugadoraService->create($data);

        return redirect()->route('jugadores.index')->with('success', 'Jugadora creada correctament!');
    }

    public function show($id)
    {
        $jugadora = $this->jugadoraService->find($id);
        return view('jugadores.show', compact('jugadora'));
    }

    public function edit($id)
    {
        $jugadora = $this->jugadoraService->find($id);
        $equips = $this->equipService->llistar();
        return view('jugadores.edit', compact('jugadora', 'equips'));
    }

    public function update(Request $request, $id) // Canviar a UpdateJugadoraRequest més endavant
    {
         $data = $request->validate([
            'nom' => 'required|string',
            'cognoms' => 'required|string',
            'dorsal' => 'required|integer',
            'equip_id' => 'required|exists:equips,id',
            'data_naixement' => 'required|date',
        ]);

        $this->jugadoraService->update($id, $data);

        return redirect()->route('jugadores.index')->with('success', 'Jugadora actualitzada!');
    }

    public function destroy($id)
    {
        $this->jugadoraService->delete($id);
        return redirect()->route('jugadores.index');
    }
}