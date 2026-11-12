<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AcaoTerritorio extends Model
{
    protected $table = 'acao_territorios';

    protected $fillable = [
        'acao_id',
        'territorio_id',
    ];

    public function acao(): BelongsTo
    {
        return $this->belongsTo(Acao::class, 'acao_id');
    }

    public function territorio(): BelongsTo
    {
        return $this->belongsTo(Territorio::class, 'territorio_id');
    }
}
