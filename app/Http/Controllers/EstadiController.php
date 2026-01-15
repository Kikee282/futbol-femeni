<?php

namespace App\Http\Controllers;

use App\Models\Estadi;
use App\Http\Requests\EstadiRequest; // Usamos tu validación personalizada
use Illuminate\Http\Request;

class EstadiController extends Controller
{
    public function index()
    {
        $estadis = Estadi::all();
        return view('estadis.index', compact('estadis'));
    }

    // --- ESTE ES EL MÉTODO QUE FALTABA ---
    public function show(Estadi $estadi) 
    {
        // Cargamos también los equipos locales y visitantes de los partidos para optimizar
        $estadi->load('equips', 'partits.local', 'partits.visitant');
        return view('estadis.show', compact('estadi'));
    }
    // -------------------------------------

    public function create() 
    { 
        return view('estadis.create'); 
    }

    public function store(EstadiRequest $request)
    {
        Estadi::create($request->validated());
        return redirect()->route('estadis.index')->with('success', 'Estadi creat correctament!');
    }

    public function edit(Estadi $estadi)
    {
        return view('estadis.edit', compact('estadi'));
    }

    public function update(EstadiRequest $request, Estadi $estadi)
    {
        $estadi->update($request->validated());
        return redirect()->route('estadis.index')->with('success', 'Estadi actualitzat correctament!');
    }

    public function destroy(Estadi $estadi)
    {
        // Opcional: Verificar si tiene partidos antes de borrar
        $estadi->delete();
        return redirect()->route('estadis.index')->with('success', 'Estadi eliminat!');
    }
}