<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    protected $table = 'usuarios';

    protected $fillable = [
        'pessoa_id',
        'email',
        'password',
        'status',
    ];

    protected $hidden = ['password'];

    // Persistent login tokens are not part of the supplied diagram.
    protected $rememberTokenName = '';

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function pessoa(): BelongsTo
    {
        return $this->belongsTo(Pessoa::class, 'pessoa_id');
    }

    public function recuperacoesSenha(): HasMany
    {
        return $this->hasMany(RecuperacaoSenha::class, 'usuario_id');
    }

    public function sessoesUsuario(): HasMany
    {
        return $this->hasMany(SessaoUsuario::class, 'usuario_id');
    }

    public function vinculosOrganizacionais(): HasMany
    {
        return $this->hasMany(VinculoOrganizacional::class, 'usuario_id');
    }

    public function acessosTerritoriais(): HasMany
    {
        return $this->hasMany(AcessoTerritorial::class, 'concedido_por_id');
    }

    public function ocorrencias(): HasMany
    {
        return $this->hasMany(Ocorrencia::class, 'registrado_por_id');
    }

    public function arquivosPorEnviadoPor(): HasMany
    {
        return $this->hasMany(Arquivo::class, 'enviado_por_id');
    }

    public function arquivosPorRevisadoPor(): HasMany
    {
        return $this->hasMany(Arquivo::class, 'revisado_por_id');
    }

    public function historicosOcorrencia(): HasMany
    {
        return $this->hasMany(HistoricoOcorrencia::class, 'ator_usuario_id');
    }

    public function mensagensOcorrencia(): HasMany
    {
        return $this->hasMany(MensagemOcorrencia::class, 'usuario_id');
    }

    public function encaminhamentosPorEnviadoPor(): HasMany
    {
        return $this->hasMany(Encaminhamento::class, 'enviado_por_id');
    }

    public function encaminhamentosPorResponsavel(): HasMany
    {
        return $this->hasMany(Encaminhamento::class, 'responsavel_id');
    }

    public function acoesPorResponsavel(): HasMany
    {
        return $this->hasMany(Acao::class, 'responsavel_id');
    }

    public function acoesPorCriadoPor(): HasMany
    {
        return $this->hasMany(Acao::class, 'criado_por_id');
    }

    public function atualizacoesAcao(): HasMany
    {
        return $this->hasMany(AtualizacaoAcao::class, 'usuario_id');
    }

    public function avaliacoesAcao(): HasMany
    {
        return $this->hasMany(AvaliacaoAcao::class, 'usuario_id');
    }

    public function notificacoes(): HasMany
    {
        return $this->hasMany(Notificacao::class, 'usuario_id');
    }

    public function cienciasPrivacidade(): HasMany
    {
        return $this->hasMany(CienciaPrivacidade::class, 'usuario_id');
    }

    public function auditorias(): HasMany
    {
        return $this->hasMany(Auditoria::class, 'usuario_id');
    }
}
