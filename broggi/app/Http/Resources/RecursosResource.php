<?php

namespace App\Http\Resources;

use App\Models\Recursos;
use App\Http\Resources\TipusRecursosResource;
use Illuminate\Http\Resources\Json\JsonResource;

class RecursosResource extends JsonResource
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
            'codi' => $this->codi,
            'actiu' => $this->actiu,
            'tipus_recursos_id'=> Recursos::with('tipus_recursos')->find($this->id)->tipus_recursos
        ];
    }
}
