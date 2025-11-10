<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PartitsController extends Controller
{
    private function getPartitsData()
    {
        return [
            ['id' => 1, 'local' => 'Barça Femení', 'visitant' => 'Atlètic de Madrid', 'data' => '2024-11-30', 'resultat' => null],
            ['id' => 2, 'local' => 'Real Madrid Femení', 'visitant' => 'Barça Femení', 'data' => '2024-12-15', 'resultat' => '0-3'],
        ];
    }

    public function index()
    {
        $partits = session()->get('partits');
        if (is_null($partits)) {
            $partits = $this->getPartitsData();
            session()->put('partits', $partits);
        }
        return view('partits.index', compact('partits'));
    }

    public function create()
    {
        return view('partits.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'local' => 'required|string|min:2',
            'visitant' => 'required|string|min:2|different:local',
            'data' => 'required|date_format:Y-m-d',
            'resultat' => 'nullable|string|regex:/^\d+-\d+$/',
        ], [
            'resultat.regex' => 'El format del resultat ha de ser "X-Y" (ex. 2-1).',
            'visitant.different' => 'L\'equip local i el visitant han de ser diferents.'
        ]);

        $partits = session()->get('partits', $this->getPartitsData());

        $newId = count($partits) > 0 ? max(array_column($partits, 'id')) + 1 : 1;
        
        $newPartit = [
            'id' => $newId,
            'local' => $validated['local'],
            'visitant' => $validated['visitant'],
            'data' => $validated['data'],
            'resultat' => $validated['resultat'], 
        ];

        $partits[] = $newPartit;
        session()->put('partits', $partits);

        return redirect()->route('partits.index')->with('success', 'Partit creat correctament.');
    }
}