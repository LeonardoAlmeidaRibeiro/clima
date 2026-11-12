<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ImportacaoClimatica extends Model
{
    protected $table = 'importacoes_climaticas';

    protected $fillable = [
        'fonte_id',
        'status',
        'iniciada_em',
        'finalizada_em',
        'quantidade',
    ];

    protected function casts(): array
    {
        return [
            'iniciada_em' => 'datetime',
            'finalizada_em' => 'datetime',
            'quantidade' => 'integer',
        ];
    }

    public function fonte(): BelongsTo
    {
        return $this->belongsTo(FonteClimatica::class, 'fonte_id');
    }

    public function medicoesClimaticas(): HasMany
    {
        return $this->hasMany(MedicaoClimatica::class, 'importacao_id');
    }
}
