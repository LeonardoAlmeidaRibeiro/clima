<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Territorio extends Model
{
    protected $table = 'territorios';

    protected $fillable = [
        'pai_id',
        'nome',
        'tipo',
        'codigo_oficial',
    ];

    public function pai(): BelongsTo
    {
        return $this->belongsTo(Territorio::class, 'pai_id');
    }

    public function territorios(): HasMany
    {
        return $this->hasMany(Territorio::class, 'pai_id');
    }

    public function territorioHierarquiaPorAncestral(): HasMany
    {
        return $this->hasMany(TerritorioHierarquia::class, 'ancestral_id');
    }

    public function territorioHierarquiaPorDescendente(): HasMany
    {
        return $this->hasMany(TerritorioHierarquia::class, 'descendente_id');
    }

    public function locais(): HasMany
    {
        return $this->hasMany(Local::class, 'territorio_id');
    }

    public function organizacoesSediadas(): HasMany
    {
        return $this->hasMany(Organizacao::class, 'territorio_sede_id');
    }

    public function organizacaoTerritorios(): HasMany
    {
        return $this->hasMany(OrganizacaoTerritorio::class, 'territorio_id');
    }

    public function acessosTerritoriais(): HasMany
    {
        return $this->hasMany(AcessoTerritorial::class, 'territorio_id');
    }

    public function ocorrencias(): HasMany
    {
        return $this->hasMany(Ocorrencia::class, 'territorio_id');
    }

    public function acaoTerritorios(): HasMany
    {
        return $this->hasMany(AcaoTerritorio::class, 'territorio_id');
    }

    public function pontosMonitoramento(): HasMany
    {
        return $this->hasMany(PontoMonitoramento::class, 'territorio_id');
    }

    public function auditorias(): HasMany
    {
        return $this->hasMany(Auditoria::class, 'territorio_id');
    }

    public function acoes(): BelongsToMany
    {
        return $this->belongsToMany(Acao::class, 'acao_territorios', 'territorio_id', 'acao_id')->withPivot('id')->withTimestamps();
    }

    public function organizacoes(): BelongsToMany
    {
        return $this->belongsToMany(Organizacao::class, 'organizacao_territorios', 'territorio_id', 'organizacao_id')->withPivot('id', 'inclui_descendentes')->withTimestamps();
    }

    public function ancestrais(): BelongsToMany
    {
        return $this->belongsToMany(Territorio::class, 'territorio_hierarquia', 'descendente_id', 'ancestral_id')->withPivot('id', 'profundidade')->withTimestamps();
    }

    public function descendentes(): BelongsToMany
    {
        return $this->belongsToMany(Territorio::class, 'territorio_hierarquia', 'ancestral_id', 'descendente_id')->withPivot('id', 'profundidade')->withTimestamps();
    }
}
