<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistoricoOcorrencia extends Model
{
    protected $table = 'historicos_ocorrencia';

    protected $fillable = [
        'ocorrencia_id',
        'ator_usuario_id',
        'evento',
        'valor_anterior',
        'valor_novo',
        'justificativa',
    ];

    public function ocorrencia(): BelongsTo
    {
        return $this->belongsTo(Ocorrencia::class, 'ocorrencia_id');
    }

    public function atorUsuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'ator_usuario_id');
    }
}
