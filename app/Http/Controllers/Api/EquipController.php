<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Equip;
use App\Http\Resources\EquipResource;
use App\Http\Requests\StoreEquipRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EquipController extends Controller
{
    public function index()
    {
        return EquipResource::collection(Equip::with('estadi')->paginate(10));
    }

    public function store(StoreEquipRequest $request)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json(['message' => 'No autoritzat'], 403);
        }

        $equip = Equip::create($request->validated());
        return new EquipResource($equip);
    }

    public function show(Equip $equip)
    {
        return new EquipResource($equip->load('estadi'));
    }

    public function update(StoreEquipRequest $request, Equip $equip)
    {
        if (!Gate::allows('update', $equip)) {
            return response()->json(['message' => 'No autoritzat'], 403);
        }

        $equip->update($request->validated());
        return new EquipResource($equip);
    }

    public function destroy(Request $request, Equip $equip)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json(['message' => 'No autoritzat'], 403);
        }

        $equip->delete();
        return response()->json(null, 204);
    }
}