<?php

namespace App\Models;

use App\Models\Usuaris;
use App\Models\Incidencies;
use App\Models\Tipus_recursos;
use App\Models\IncidenciesHasRecursos;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recursos extends Model
{
    use HasFactory;

    protected $table = 'recursos';
    public $timestamps = false;

    public function tipus_recursos(){
        return $this->belongsTo(Tipus_recursos::class, 'tipus_recursos_id');
    }

    public function usuaris()
    {
        return $this->hasMany(Usuaris::class, 'recursos_id');
    }

    // public function incidencies_has_recursos(){
    //     return $this->belongsToMany(Incidencies::class, 'incidencies_has_recursos', 'recursos_id', 'incidencies_id')
    //     ->withPivot('hora_activacio', 'hora_mobilitzacio', 'hora_assistencia', 'hora_transport', 'hora_arribada_hospital', 'hora_transferencia', 'hora_finalitzacio', 'prioritat', 'desti');
    // }

    public function incidencies_has_recursos(): HasMany{
        return $this->hasMany(IncidenciesHasRecursos::class, 'recursos_id');
    }

}
