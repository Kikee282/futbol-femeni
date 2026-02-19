<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PartitResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'local' => $this->local->nom,
            'visitant' => $this->visitant->nom,
            'gols_local' => $this->gols_local,
            'gols_visitant' => $this->gols_visitant,
            'data' => $this->data,
            'arbitre' => $this->arbitre,
        ];
    }
}