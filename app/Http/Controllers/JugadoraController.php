<?php

namespace App\Http\Controllers;

use App\Models\Jugadora;
use App\Models\Equip;
use App\Http\Requests\JugadoraRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JugadoraController extends Controller
{
    // Definimos las posiciones posibles como una constante o propiedad privada
    private $posicions = ['Portera', 'Defensa', 'Migcampista', 'Davantera'];

    public function index()
    {
        $jugadores = Jugadora::all();
        return view('jugadores.index', compact('jugadores'));
    }

    public function create()
    {
        $equips = Equip::all();
        // Pasamos la lista de posiciones a la vista
        $posicions = $this->posicions;
        
        return view('jugadores.create', compact('equips', 'posicions'));
    }

    public function store(JugadoraRequest $request)
    {
        $datos = $request->validated();

        if ($request->hasFile('foto')) {
            $datos['foto'] = $request->file('foto')->store('jugadores', 'public');
        }

        Jugadora::create($datos);

        return redirect()->route('jugadores.index')->with('success', 'Jugadora creada!');
    }

    public function edit(Jugadora $jugadora)
    {
        $equips = Equip::all();
        // También necesitamos las posiciones al editar
        $posicions = $this->posicions; 

        return view('jugadores.edit', compact('jugadora', 'equips', 'posicions'));
    }

    public function update(JugadoraRequest $request, Jugadora $jugadora)
    {
        $datos = $request->validated();

        if ($request->hasFile('foto')) {
            if ($jugadora->foto) {
                Storage::disk('public')->delete($jugadora->foto);
            }
            $datos['foto'] = $request->file('foto')->store('jugadores', 'public');
        }

        $jugadora->update($datos);

        return redirect()->route('jugadores.index')->with('success', 'Jugadora actualitzada!');
    }

    public function destroy(Jugadora $jugadora)
    {
        if ($jugadora->foto) {
            Storage::disk('public')->delete($jugadora->foto);
        }
        $jugadora->delete();
        return redirect()->route('jugadores.index')->with('success', 'Jugadora eliminada!');
    }
}