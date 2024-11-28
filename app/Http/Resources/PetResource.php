<?php

namespace App\Http\Resources;

use App\Http\Resources\ClientResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'breed' => $this->breed,
            'age' => $this->age,
            'medical_conditions' => $this->medical_conditions,
            'client' => new ClientResource($this->whenLoaded('client')), // Usando el Resource Client
            'created_at' => $this->created_at->toIso8601String(),
            'updated_at' => $this->updated_at->toIso8601String(),
        ];
    }
}
