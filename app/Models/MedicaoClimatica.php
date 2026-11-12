<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicaoClimatica extends Model
{
    protected $table = 'medicoes_climaticas';

    protected $fillable = [
        'ponto_id',
        'indicador_id',
        'importacao_id',
        'periodo_inicio',
        'periodo_fim',
        'valor',
        'qualidade',
    ];

    protected function casts(): array
    {
        return [
            'periodo_inicio' => 'datetime',
            'periodo_fim' => 'datetime',
            'valor' => 'decimal:6',
        ];
    }

    public function ponto(): BelongsTo
    {
        return $this->belongsTo(PontoMonitoramento::class, 'ponto_id');
    }

    public function indicador(): BelongsTo
    {
        return $this->belongsTo(IndicadorClimatico::class, 'indicador_id');
    }

    public function importacao(): BelongsTo
    {
        return $this->belongsTo(ImportacaoClimatica::class, 'importacao_id');
    }
}
