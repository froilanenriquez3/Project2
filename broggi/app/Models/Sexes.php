<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sexes extends Model
{
    use HasFactory;

    //Enlazamos la tabla con la clase
    protected $table = 'sexes';
    public $timestamps = false;


    //Relaciones entre tablas
    
    //Relación con la tabla afectats
    public function afectats()
    {
        return $this->hasMany(Afectats::class, 'sexes_id');
    }

}
