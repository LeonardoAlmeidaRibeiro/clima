<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pessoa extends Model
{
    protected $table = 'pessoas';

    protected $fillable = [
        'nome',
        'nome_social',
    ];

    public function pessoaContatos(): HasMany
    {
        return $this->hasMany(PessoaContato::class, 'pessoa_id');
    }

    public function usuarios(): HasMany
    {
        return $this->hasMany(Usuario::class, 'pessoa_id');
    }

    public function ocorrencias(): HasMany
    {
        return $this->hasMany(Ocorrencia::class, 'relator_pessoa_id');
    }
}
