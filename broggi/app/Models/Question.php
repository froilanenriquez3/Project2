<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $table = 'Question';
    public $timestamps = false;

    public function answer()
    {
        return $this->hasMany(Answer::class, 'Question_id');
    }
}
