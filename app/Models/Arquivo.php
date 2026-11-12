<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Arquivo extends Model
{
    protected $table = 'arquivos';

    protected $fillable = [
        'enviado_por_id',
        'revisado_por_id',
        'storage_key',
        'nome_original',
        'mime_type',
        'tamanho_bytes',
        'status_revisao',
    ];

    protected function casts(): array
    {
        return [
            'tamanho_bytes' => 'integer',
        ];
    }

    public function enviadoPor(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'enviado_por_id');
    }

    public function revisadoPor(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'revisado_por_id');
    }

    public function ocorrenciaArquivos(): HasMany
    {
        return $this->hasMany(OcorrenciaArquivo::class, 'arquivo_id');
    }

    public function acaoArquivos(): HasMany
    {
        return $this->hasMany(AcaoArquivo::class, 'arquivo_id');
    }

    public function ocorrencias(): BelongsToMany
    {
        return $this->belongsToMany(Ocorrencia::class, 'ocorrencia_arquivos', 'arquivo_id', 'ocorrencia_id')->withPivot('id', 'legenda')->withTimestamps();
    }

    public function acoes(): BelongsToMany
    {
        return $this->belongsToMany(Acao::class, 'acao_arquivos', 'arquivo_id', 'acao_id')->withPivot('id', 'fase')->withTimestamps();
    }
}
