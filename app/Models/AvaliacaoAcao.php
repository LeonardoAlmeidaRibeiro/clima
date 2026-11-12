<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AvaliacaoAcao extends Model
{
    protected $table = 'avaliacoes_acao';

    protected $fillable = [
        'acao_id',
        'ocorrencia_id',
        'usuario_id',
        'percepcao',
        'comentario',
    ];

    public function acao(): BelongsTo
    {
        return $this->belongsTo(Acao::class, 'acao_id');
    }

    public function ocorrencia(): BelongsTo
    {
        return $this->belongsTo(Ocorrencia::class, 'ocorrencia_id');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
