<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Acao extends Model
{
    protected $table = 'acoes';

    protected $fillable = [
        'organizacao_id',
        'responsavel_id',
        'criado_por_id',
        'titulo',
        'descricao',
        'status',
        'prazo',
        'iniciada_em',
        'concluida_em',
    ];

    protected function casts(): array
    {
        return [
            'prazo' => 'datetime',
            'iniciada_em' => 'datetime',
            'concluida_em' => 'datetime',
        ];
    }

    public function organizacao(): BelongsTo
    {
        return $this->belongsTo(Organizacao::class, 'organizacao_id');
    }

    public function responsavel(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'responsavel_id');
    }

    public function criadoPor(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'criado_por_id');
    }

    public function acaoOcorrencias(): HasMany
    {
        return $this->hasMany(AcaoOcorrencia::class, 'acao_id');
    }

    public function acaoTerritorios(): HasMany
    {
        return $this->hasMany(AcaoTerritorio::class, 'acao_id');
    }

    public function atualizacoesAcao(): HasMany
    {
        return $this->hasMany(AtualizacaoAcao::class, 'acao_id');
    }

    public function acaoArquivos(): HasMany
    {
        return $this->hasMany(AcaoArquivo::class, 'acao_id');
    }

    public function avaliacoesAcao(): HasMany
    {
        return $this->hasMany(AvaliacaoAcao::class, 'acao_id');
    }

    public function notificacoes(): HasMany
    {
        return $this->hasMany(Notificacao::class, 'acao_id');
    }

    public function ocorrencias(): BelongsToMany
    {
        return $this->belongsToMany(Ocorrencia::class, 'acao_ocorrencias', 'acao_id', 'ocorrencia_id')->withPivot('id')->withTimestamps();
    }

    public function territorios(): BelongsToMany
    {
        return $this->belongsToMany(Territorio::class, 'acao_territorios', 'acao_id', 'territorio_id')->withPivot('id')->withTimestamps();
    }

    public function arquivos(): BelongsToMany
    {
        return $this->belongsToMany(Arquivo::class, 'acao_arquivos', 'acao_id', 'arquivo_id')->withPivot('id', 'fase')->withTimestamps();
    }
}
