<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organizacao extends Model
{
    protected $table = 'organizacoes';

    protected $fillable = [
        'organizacao_pai_id',
        'territorio_sede_id',
        'nome',
        'sigla',
        'tipo',
    ];

    public function organizacaoPai(): BelongsTo
    {
        return $this->belongsTo(Organizacao::class, 'organizacao_pai_id');
    }

    public function organizacoes(): HasMany
    {
        return $this->hasMany(Organizacao::class, 'organizacao_pai_id');
    }

    public function territorioSede(): BelongsTo
    {
        return $this->belongsTo(Territorio::class, 'territorio_sede_id');
    }

    public function organizacaoTerritorios(): HasMany
    {
        return $this->hasMany(OrganizacaoTerritorio::class, 'organizacao_id');
    }

    public function vinculosOrganizacionais(): HasMany
    {
        return $this->hasMany(VinculoOrganizacional::class, 'organizacao_id');
    }

    public function encaminhamentos(): HasMany
    {
        return $this->hasMany(Encaminhamento::class, 'organizacao_destino_id');
    }

    public function acoes(): HasMany
    {
        return $this->hasMany(Acao::class, 'organizacao_id');
    }

    public function territorios(): BelongsToMany
    {
        return $this->belongsToMany(Territorio::class, 'organizacao_territorios', 'organizacao_id', 'territorio_id')->withPivot('id', 'inclui_descendentes')->withTimestamps();
    }
}
