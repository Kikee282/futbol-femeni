<?php

namespace App\Http\Controllers;

use App\Models\Partit;
use App\Http\Requests\PartitRequest; // <--- Importamos el Request nuevo
use Illuminate\Http\Request;

class PartitController extends Controller
{
    public function index()
{
    // Cambia get() o all() por paginate(10)
    $partits = Partit::with(['local', 'visitant', 'estadi'])
                    ->orderBy('data', 'asc')
                    ->paginate(10); 

    return view('partits.index', compact('partits'));
}

    public function show(Partit $partit)
    {
        return view('partits.show', compact('partit'));
    }

    public function edit(Partit $partit)
    {
        // Usamos authorize del Request indirectamente si lo llamasemos, 
        // pero aquí podemos dejar pasar a la vista y que el update filtre después,
        // o usar Gate::authorize('update', $partit); si tienes Policies.
        
        $golsLocal = $partit->gols['local'] ?? '';
        $golsVisitant = $partit->gols['visitant'] ?? '';

        return view('partits.edit', compact('partit', 'golsLocal', 'golsVisitant'));
    }

    // Usamos PartitRequest. Laravel ejecuta authorize() y rules() antes de entrar aquí.
    public function update(PartitRequest $request, Partit $partit)
    {
        // NO hace falta validar manual, ya lo hizo el Request.
        
        // Empaquetamos el JSON
        $partit->gols = [
            'local' => intval($request->gols_local),
            'visitant' => intval($request->gols_visitant),
        ];

        $partit->save();

        return redirect()->route('partits.index')->with('success', 'Resultat actualitzat!');
    }
}