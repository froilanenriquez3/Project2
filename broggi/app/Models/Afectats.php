<?php

namespace App\Models;

use App\Http\Controllers\AfectatsController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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


}
