<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FonteClimatica extends Model
{
    protected $table = 'fontes_climaticas';

    protected $fillable = [
        'nome',
        'codigo',
        'url',
    ];

    public function pontosMonitoramento(): HasMany
    {
        return $this->hasMany(PontoMonitoramento::class, 'fonte_id');
    }

    public function importacoesClimaticas(): HasMany
    {
        return $this->hasMany(ImportacaoClimatica::class, 'fonte_id');
    }
}
