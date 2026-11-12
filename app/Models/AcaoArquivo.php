<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AcaoArquivo extends Model
{
    protected $table = 'acao_arquivos';

    protected $fillable = [
        'acao_id',
        'arquivo_id',
        'fase',
    ];

    public function acao(): BelongsTo
    {
        return $this->belongsTo(Acao::class, 'acao_id');
    }

    public function arquivo(): BelongsTo
    {
        return $this->belongsTo(Arquivo::class, 'arquivo_id');
    }
}
