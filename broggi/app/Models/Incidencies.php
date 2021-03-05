<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function incidencies_has_recursos(){
        return $this->belongsToMany(Recursos::class, 'incidencies_has_recursos', 'incidencies_id', 'recursos_id')->withPivot('id');
    }


}
