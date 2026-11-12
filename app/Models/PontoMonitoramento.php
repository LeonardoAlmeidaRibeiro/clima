<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PontoMonitoramento extends Model
{
    protected $table = 'pontos_monitoramento';

    protected $fillable = [
        'fonte_id',
        'territorio_id',
        'codigo_externo',
        'nome',
        'latitude',
        'longitude',
    ];

    protected function casts(): array
    {
        return [
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
        ];
    }

    public function fonte(): BelongsTo
    {
        return $this->belongsTo(FonteClimatica::class, 'fonte_id');
    }

    public function territorio(): BelongsTo
    {
        return $this->belongsTo(Territorio::class, 'territorio_id');
    }

    public function medicoesClimaticas(): HasMany
    {
        return $this->hasMany(MedicaoClimatica::class, 'ponto_id');
    }
}
