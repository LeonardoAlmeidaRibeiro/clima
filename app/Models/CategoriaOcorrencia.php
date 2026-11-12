<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoriaOcorrencia extends Model
{
    protected $table = 'categorias_ocorrencia';

    protected $fillable = [
        'nome',
        'descricao',
    ];

    public function ocorrencias(): HasMany
    {
        return $this->hasMany(Ocorrencia::class, 'categoria_id');
    }
}
