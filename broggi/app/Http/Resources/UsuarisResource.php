<?php

namespace App\Http\Resources;


use App\Models\Rols;
use App\Models\Recursos;
use Illuminate\Http\Resources\Json\JsonResource;

class UsuarisResource extends JsonResource
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
            'username' => $this->username,
            'nom' => $this->nom,
            'cognoms' => $this->cognoms,
            'email' => $this->email,
            'rols_id'=> Rols::with('usuaris')->find($this->id)->nom
        ];

    }
}
