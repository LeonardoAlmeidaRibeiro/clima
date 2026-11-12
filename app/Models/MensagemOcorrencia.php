<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MensagemOcorrencia extends Model
{
    protected $table = 'mensagens_ocorrencia';

    protected $fillable = [
        'ocorrencia_id',
        'usuario_id',
        'autor_tipo',
        'mensagem',
        'publica',
    ];

    protected function casts(): array
    {
        return [
            'publica' => 'boolean',
        ];
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
