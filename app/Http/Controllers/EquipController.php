<?php

namespace App\Http\Controllers;

use App\Models\Equip;
use App\Models\Estadi;
use App\Http\Requests\StoreEquipRequest;  // <--- Importamos tus Requests existentes
use App\Http\Requests\UpdateEquipRequest; // <--- Importamos tus Requests existentes
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EquipController extends Controller
{
    public function index()
    {
        $equips = Equip::with('estadi')->paginate(10);

        return view('equips.index', compact('equips'));
    }

    public function create()
    {
        $estadis = Estadi::all();
        return view('equips.create', compact('estadis'));
    }

    // Usamos StoreEquipRequest en lugar de Request
    public function store(StoreEquipRequest $request)
    {
        // 1. La validación ya se ha hecho automáticamente. Obtenemos los datos validados.
        $datos = $request->validated();

        // 2. Gestión de la imagen (Escut)
        if ($request->hasFile('escut')) {
            $ruta = $request->file('escut')->store('escuts', 'public');
            $datos['escut'] = $ruta;
        }

        // 3. Crear
        Equip::create($datos);

        return redirect()->route('equips.index')->with('success', 'Equip creat correctament!');
    }

    public function show(Equip $equip)
    {
        return view('equips.show', compact('equip'));
    }

    public function edit(Equip $equip)
    {
        $estadis = Estadi::all();
        return view('equips.edit', compact('equip', 'estadis'));
    }

    // Usamos UpdateEquipRequest en lugar de Request
    public function update(UpdateEquipRequest $request, Equip $equip)
    {
        // 1. Obtener datos validados
        $datos = $request->validated();

        // 2. Gestión de la imagen si se sube una nueva
        if ($request->hasFile('escut')) {
            // Borrar la vieja si existe
            if ($equip->escut) {
                Storage::disk('public')->delete($equip->escut);
            }
            $datos['escut'] = $request->file('escut')->store('escuts', 'public');
        }

        // 3. Actualizar
        $equip->update($datos);

        return redirect()->route('equips.index')->with('success', 'Equip actualitzat!');
    }

    public function destroy(Equip $equip)
    {
        if ($equip->escut) {
            Storage::disk('public')->delete($equip->escut);
        }
        $equip->delete();
        return redirect()->route('equips.index')->with('success', 'Equip eliminat!');
    }
}