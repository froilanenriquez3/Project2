<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recursos extends Model
{
    use HasFactory;

    protected $table = 'recursos';
    public $timestamps = false;

    public function tipus_recursos(){
        return $this->belongsTo(Tipus_recursos::class, 'tipus_recursos_id');
    }

    public function incidencies_has_recursos(){
        return $this->belongsToMany(Recursos::class, 'incidencies_has_recursos',  'recursos_id', 'incidencies_id')->withPivot('id');
    }

}
