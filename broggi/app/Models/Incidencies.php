<?php

namespace App\Models;

use App\Models\Usuaris;
use App\Models\Afectats;
use App\Models\Question;
use App\Models\Recursos;
use App\Models\Alertants;
use App\Models\Municipis;
use App\Models\Tipus_incidencias;
use App\Models\IncidenciesHasRecursos;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Incidencies extends Model
{
    use HasFactory;

    protected $table = 'incidencies';
    public $timestamps = false;


    public function tipus_incidencies(){
        return $this->belongsTo(Tipus_incidencias::class, 'tipus_incidencies_id');
    }

    public function questions(){
        return $this->hasMany(Question::class, 'incidencies_id');
    }

    public function usuaris()
    {
        return $this->belongsTo(Usuaris::class, 'usuaris_id');
    }

    public function alertants()
    {
        return $this->belongsTo(Alertants::class, 'alertants_id');
    }


    //Relación con la tabla municipis
    public function municipis()
    {
        return $this->belongsTo(Municipis::class, 'municipis_id');
    }

    // public function incidencies_has_recursos(){
    //     return $this->belongsToMany(Recursos::class, 'incidencies_has_recursos', 'incidencies_id', 'recursos_id')
    //     ->withPivot('hora_activacio', 'hora_mobilitzacio', 'hora_assistencia', 'hora_transport', 'hora_arribada_hospital', 'hora_transferencia', 'hora_finalitzacio', 'prioritat', 'desti');
    // }

    //Relación con la tabla afectats MN
    public function incidencies_has_afectats()
    {
        return $this->belongsToMany(Afectats::class, 'incidencies_has_afectats', 'incidencies_id', 'afectats_id');
    }

    public function incidencies_has_recursos(): HasMany{
        return $this->hasMany(IncidenciesHasRecursos::class, 'incidencies_id');
    }

}
