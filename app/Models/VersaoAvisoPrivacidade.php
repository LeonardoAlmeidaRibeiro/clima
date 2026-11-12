<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VersaoAvisoPrivacidade extends Model
{
    protected $table = 'versoes_aviso_privacidade';

    protected $fillable = [
        'versao',
        'texto',
        'publicado_em',
    ];

    protected function casts(): array
    {
        return [
            'publicado_em' => 'datetime',
        ];
    }

    public function cienciasPrivacidade(): HasMany
    {
        return $this->hasMany(CienciaPrivacidade::class, 'aviso_id');
    }
}
