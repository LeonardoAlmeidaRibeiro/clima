<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Encaminhamento extends Model
{
    protected $table = 'encaminhamentos';

    protected $fillable = [
        'ocorrencia_id',
        'organizacao_destino_id',
        'enviado_por_id',
        'responsavel_id',
        'status',
        'prazo',
    ];

    protected function casts(): array
    {
        return [
            'prazo' => 'datetime',
        ];
    }

    public function ocorrencia(): BelongsTo
    {
        return $this->belongsTo(Ocorrencia::class, 'ocorrencia_id');
    }

    public function organizacaoDestino(): BelongsTo
    {
        return $this->belongsTo(Organizacao::class, 'organizacao_destino_id');
    }

    public function enviadoPor(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'enviado_por_id');
    }

    public function responsavel(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'responsavel_id');
    }
}
