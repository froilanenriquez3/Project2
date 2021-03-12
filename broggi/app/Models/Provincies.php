<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincies extends Model
{
    use HasFactory;
    //Enlazamos la tabla con la clase
    protected $table = 'provincies';
    public $timestamps = false;

    //Relaciones entre tablas
    //Relación con la tabla comarques

    public function comarques()
    {
        return $this->hasMany(Comarques::class, 'provincies_id');
    }
}
