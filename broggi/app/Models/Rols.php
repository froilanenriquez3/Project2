<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rols extends Model
{
    use HasFactory;

    protected $table = 'rols';
    public $timestamps = false;


    public function usuaris()
    {
        return $this->hasMany(Usuaris::class, 'rols_id');
    }
}
