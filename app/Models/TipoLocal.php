<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoLocal extends Model
{
    protected $table = 'tipos_local';

    protected $fillable = [
        'nome',
    ];

    public function locais(): HasMany
    {
        return $this->hasMany(Local::class, 'tipo_local_id');
    }
}
