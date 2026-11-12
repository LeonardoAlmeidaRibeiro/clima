<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Papel extends Model
{
    protected $table = 'papeis';

    protected $fillable = [
        'codigo',
        'nome',
    ];

    public function papelPermissoes(): HasMany
    {
        return $this->hasMany(PapelPermissao::class, 'papel_id');
    }

    public function acessosTerritoriais(): HasMany
    {
        return $this->hasMany(AcessoTerritorial::class, 'papel_id');
    }

    public function permissoes(): BelongsToMany
    {
        return $this->belongsToMany(Permissao::class, 'papel_permissoes', 'papel_id', 'permissao_id')->withPivot('id')->withTimestamps();
    }
}
