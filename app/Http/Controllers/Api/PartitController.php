<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Partit;
use App\Http\Resources\PartitResource;
use App\Http\Requests\StorePartitRequest;
use Illuminate\Http\Request;

class PartitController extends Controller
{
    public function index()
    {
        return PartitResource::collection(Partit::with(['local', 'visitant'])->paginate(10));
    }

    public function store(StorePartitRequest $request)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json(['message' => 'No autoritzat'], 403);
        }

        $partit = Partit::create($request->validated());
        return new PartitResource($partit);
    }

    public function show(Partit $partit)
    {
        return new PartitResource($partit->load(['local', 'visitant']));
    }

    public function update(StorePartitRequest $request, Partit $partit)
    {
        $user = $request->user();
        $isArbitreAssignat = $user->role === 'arbitre' && $partit->arbitre === $user->name;
        $isAdmin = $user->role === 'admin';

        if (!$isAdmin && !$isArbitreAssignat) {
            return response()->json(['message' => 'No autoritzat'], 403);
        }

        $partit->update($request->validated());
        return new PartitResource($partit);
    }

    public function destroy(Request $request, Partit $partit)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json(['message' => 'No autoritzat'], 403);
        }

        $partit->delete();
        return response()->json(null, 204);
    }
}