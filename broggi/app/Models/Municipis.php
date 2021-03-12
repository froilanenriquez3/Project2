<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipis extends Model
{
    use HasFactory;
    //Enlazamos la tabla con la clase
    protected $table = 'municipis';
    public $timestamps = false;

    //Relaciones entre tablas
    //Relación con la tabla comarques

    public function comarques()
    {
        return $this->belongsTo(Comarques::class, 'comarques_id');
    }
    //Relación con la tabla alertants

    public function alertants()
    {
        return $this->hasMany(Alertants::class, 'municipis_id');
    }

    //Relación con la tabla incidencies

    public function incidencies()
    {
        return $this->hasMany(Incidencies::class, 'municipis_id');
    }
}
