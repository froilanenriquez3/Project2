<?php

namespace App\Models;

use App\Models\Afectats;
use App\Models\Recursos;
use App\Models\Incidencies;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IncidenciesHasRecursos extends Model
{
    use HasFactory;

    protected $table = 'incidencies_has_recursos';
    protected $primaryKey = ['afectat_id', 'recursos_id', 'incidencies_id'];
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [0];

    public function incidencies(): BelongsTo
    {
        return $this->belongsTo(Incidencies::class, 'incidencies_id');
    }

    public function afectats(): BelongsTo
    {
        return $this->belongsTo(Afectats::class, 'afectat_id');
    }

    public function recursos(): BelongsTo
    {
        return $this->belongsTo(Recursos::class, 'recursos_id');
    }

    /**
     * Set the keys for a save update query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function setKeysForSaveQuery($query)
    {
        $keys = $this->getKeyName();
        if (!is_array($keys)) {
            return parent::setKeysForSaveQuery($query);
        }

        foreach ($keys as $keyName) {
            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
        }

        return $query;
    }

    /**
     * Get the primary key value for a save query.
     *
     * @param mixed $keyName
     * @return mixed
     */
    protected function getKeyForSaveQuery($keyName = null)
    {
        if (is_null($keyName)) {
            $keyName = $this->getKeyName();
        }

        if (isset($this->original[$keyName])) {
            return $this->original[$keyName];
        }

        return $this->getAttribute($keyName);
    }
}
