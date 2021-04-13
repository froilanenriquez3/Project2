<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IncidenciesHasRecursos extends Model
{
    use HasFactory;

    protected $table='incidencies_has_recursos';
    protected $primariKey= ['afectat_id', 'recursos_id', 'incidencies_id'];
    public $incrementing = false;
    public $timestamps= false;

    public function incidencies(): BelongsTo{
        return $this->belongsTo(Incidencies::class, 'incidencies_id');
    }

    public function afectats(): BelongsTo{
        return $this->belongsTo(Afectats::class, 'afectat_id');
    }

    public function recursos(): BelongsTo{
        return $this->belongsTo(Recursos::class, 'recursos_id');
    }




}
