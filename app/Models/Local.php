<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Local extends Model
{
    protected $table = 'locais';

    protected $fillable = [
        'territorio_id',
        'tipo_local_id',
        'local_pai_id',
        'nome',
        'logradouro',
        'numero',
        'complemento',
        'codigo_postal',
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

    public function territorio(): BelongsTo
    {
        return $this->belongsTo(Territorio::class, 'territorio_id');
    }

    public function tipoLocal(): BelongsTo
    {
        return $this->belongsTo(TipoLocal::class, 'tipo_local_id');
    }

    public function localPai(): BelongsTo
    {
        return $this->belongsTo(Local::class, 'local_pai_id');
    }

    public function locais(): HasMany
    {
        return $this->hasMany(Local::class, 'local_pai_id');
    }

    public function ocorrencias(): HasMany
    {
        return $this->hasMany(Ocorrencia::class, 'local_id');
    }
}
