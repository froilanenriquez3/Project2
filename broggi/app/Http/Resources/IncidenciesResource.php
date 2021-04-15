<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IncidenciesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'data' => $this->data,
            'hora' => $this->hora,
            'telefon_alertant' => $this->telefon_alertant,
            'adreca' => $this->adreca,
            'adreca_complement' => $this->adreca_complement,
            'descripcio' => $this->descripcio,
            'nom_metge' => $this->nom_metge,
            'tipus_incidencies_id' => $this->tipus_incidencies_id,
            'tipus_incidencia' => $this->tipus_incidencies,
            'alertants_id' => $this->alertants_id,
            'municipis_id' => $this->municipis_id,
            'usuaris_id' => $this->usuaris_id,
            'duracion' => $this->duracion,
            'incidencies_has_recursos' => $this->incidencies_has_recursos
        ];
    }
}
