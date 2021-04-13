<?php

namespace App\Models;

use App\Models\Sexes;
use App\Models\Recursos;
use App\Models\Incidencies;
use App\Models\IncidenciesHasRecursos;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\AfectatsController;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Afectats extends Model
{
    use HasFactory;
    //Enlazamos la tabla con la clase
    protected $table = 'afectats';
    public $timestamps = false;


    //Relaciones entre tablas

    //relación con la tabla sexes
    public function sexes()
    {
        return $this->belongsTo(Sexes::class, 'sexes_id');
    }
    //relación con la tabla incidencias MN

    public function incidencies_has_afectats()
    {
        return $this->belongsToMany(Incidencies::class, 'incidencies_has_afectats', 'afectats_id', 'incidencies_id');
    }


    public function incidencies_has_recursos(): HasMany{
        return $this->hasMany(IncidenciesHasRecursos::class, 'afectat_id');
    }

//     public function incidencies_has_recursos()
//     {
//         return $this->belongsToMany(Recursos::class, 'incidencies_has_recursos', 'incidencies_id', 'recursos_id')
//         ->withPivot('hora_activacio', 'hora_mobilitzacio', 'hora_assistencia', 'hora_transport', 'hora_arribada_hospital', 'hora_transferencia', 'hora_finalitzacio', 'prioritat', 'desti');

//     }



}
