<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Permissao extends Model
{
    protected $table = 'permissoes';

    protected $fillable = [
        'codigo',
        'descricao',
    ];

    public function papelPermissoes(): HasMany
    {
        return $this->hasMany(PapelPermissao::class, 'permissao_id');
    }

    public function papeis(): BelongsToMany
    {
        return $this->belongsToMany(Papel::class, 'papel_permissoes', 'permissao_id', 'papel_id')->withPivot('id')->withTimestamps();
    }
}
