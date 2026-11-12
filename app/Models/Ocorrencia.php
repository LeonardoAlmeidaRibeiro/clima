<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ocorrencia extends Model
{
    protected $table = 'ocorrencias';

    protected $fillable = [
        'protocolo',
        'local_id',
        'territorio_id',
        'categoria_id',
        'relator_pessoa_id',
        'registrado_por_id',
        'ocorrencia_original_id',
        'titulo',
        'descricao',
        'ocorrido_em',
        'latitude',
        'longitude',
        'gravidade_informada',
        'prioridade_gestao',
        'status_moderacao',
        'status_atendimento',
        'visibilidade',
    ];

    protected function casts(): array
    {
        return [
            'ocorrido_em' => 'datetime',
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
        ];
    }

    public function local(): BelongsTo
    {
        return $this->belongsTo(Local::class, 'local_id');
    }

    public function territorio(): BelongsTo
    {
        return $this->belongsTo(Territorio::class, 'territorio_id');
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(CategoriaOcorrencia::class, 'categoria_id');
    }

    public function relatorPessoa(): BelongsTo
    {
        return $this->belongsTo(Pessoa::class, 'relator_pessoa_id');
    }

    public function registradoPor(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'registrado_por_id');
    }

    public function ocorrenciaOriginal(): BelongsTo
    {
        return $this->belongsTo(Ocorrencia::class, 'ocorrencia_original_id');
    }

    public function ocorrencias(): HasMany
    {
        return $this->hasMany(Ocorrencia::class, 'ocorrencia_original_id');
    }

    public function contatosOcorrencia(): HasMany
    {
        return $this->hasMany(ContatoOcorrencia::class, 'ocorrencia_id');
    }

    public function acessosAcompanhamento(): HasMany
    {
        return $this->hasMany(AcessoAcompanhamento::class, 'ocorrencia_id');
    }

    public function ocorrenciaArquivos(): HasMany
    {
        return $this->hasMany(OcorrenciaArquivo::class, 'ocorrencia_id');
    }

    public function historicosOcorrencia(): HasMany
    {
        return $this->hasMany(HistoricoOcorrencia::class, 'ocorrencia_id');
    }

    public function mensagensOcorrencia(): HasMany
    {
        return $this->hasMany(MensagemOcorrencia::class, 'ocorrencia_id');
    }

    public function encaminhamentos(): HasMany
    {
        return $this->hasMany(Encaminhamento::class, 'ocorrencia_id');
    }

    public function acaoOcorrencias(): HasMany
    {
        return $this->hasMany(AcaoOcorrencia::class, 'ocorrencia_id');
    }

    public function avaliacoesAcao(): HasMany
    {
        return $this->hasMany(AvaliacaoAcao::class, 'ocorrencia_id');
    }

    public function notificacoes(): HasMany
    {
        return $this->hasMany(Notificacao::class, 'ocorrencia_id');
    }

    public function cienciasPrivacidade(): HasMany
    {
        return $this->hasMany(CienciaPrivacidade::class, 'ocorrencia_id');
    }

    public function acoes(): BelongsToMany
    {
        return $this->belongsToMany(Acao::class, 'acao_ocorrencias', 'ocorrencia_id', 'acao_id')->withPivot('id')->withTimestamps();
    }

    public function arquivos(): BelongsToMany
    {
        return $this->belongsToMany(Arquivo::class, 'ocorrencia_arquivos', 'ocorrencia_id', 'arquivo_id')->withPivot('id', 'legenda')->withTimestamps();
    }
}
