<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Estadi;
use App\Http\Resources\EstadiResource;
use App\Http\Requests\StoreEstadiRequest;
use Illuminate\Http\Request;

class EstadiController extends Controller
{
    public function index()
    {
        return EstadiResource::collection(Estadi::paginate(10));
    }

    public function store(StoreEstadiRequest $request)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json(['message' => 'No autoritzat'], 403);
        }

        $estadi = Estadi::create($request->validated());
        return new EstadiResource($estadi);
    }

    public function show(Estadi $estadi)
    {
        return new EstadiResource($estadi);
    }

    public function update(StoreEstadiRequest $request, Estadi $estadi)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json(['message' => 'No autoritzat'], 403);
        }

        $estadi->update($request->validated());
        return new EstadiResource($estadi);
    }

    public function destroy(Request $request, Estadi $estadi)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json(['message' => 'No autoritzat'], 403);
        }

        $estadi->delete();
        return response()->json(null, 204);
    }
}