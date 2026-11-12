<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class IndicadorClimatico extends Model
{
    protected $table = 'indicadores_climaticos';

    protected $fillable = [
        'codigo',
        'nome',
        'unidade',
        'agregacao',
    ];

    public function medicoesClimaticas(): HasMany
    {
        return $this->hasMany(MedicaoClimatica::class, 'indicador_id');
    }
}
