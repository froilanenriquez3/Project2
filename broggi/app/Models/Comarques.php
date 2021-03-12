<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comarques extends Model
{
    use HasFactory;
    //Enlazamos la tabla con la clase
    protected $table = 'comarques';
    public $timestamps = false;

    //Relaciones entre tablas
    //Relación con la tabla provincies

    public function provincies()
    {
        return $this->belongsTo(Provincies::class, 'provincies_id');
    }

    //Relación con la tabla municipis
    public function municipis()
    {
       return $this->hasMany(municipis::class, 'comarques_id');
    }

}
