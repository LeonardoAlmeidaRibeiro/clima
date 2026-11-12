<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OcorrenciaArquivo extends Model
{
    protected $table = 'ocorrencia_arquivos';

    protected $fillable = [
        'ocorrencia_id',
        'arquivo_id',
        'legenda',
    ];

    public function ocorrencia(): BelongsTo
    {
        return $this->belongsTo(Ocorrencia::class, 'ocorrencia_id');
    }

    public function arquivo(): BelongsTo
    {
        return $this->belongsTo(Arquivo::class, 'arquivo_id');
    }
}
