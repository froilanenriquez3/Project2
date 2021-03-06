<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuaris extends Model
{
    use HasFactory;

    protected $table = 'usuaris';
    public $timestamps = false;

    public function incidencies()
    {
        return $this->hasMany(Incidencies::class, 'usuaris_id');
    }

    public function recursos()
    {
        return $this->belongsTo(Recursos::class, 'recursos_id');
    }

    public function rols()
    {
        return $this->belongsTo(Rols::class, 'rols_id');
    }

}
