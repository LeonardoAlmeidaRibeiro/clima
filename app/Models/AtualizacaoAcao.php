<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AtualizacaoAcao extends Model
{
    protected $table = 'atualizacoes_acao';

    protected $fillable = [
        'acao_id',
        'usuario_id',
        'status_anterior',
        'status_novo',
        'descricao',
    ];

    public function acao(): BelongsTo
    {
        return $this->belongsTo(Acao::class, 'acao_id');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
