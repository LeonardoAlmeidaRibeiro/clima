<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VinculoOrganizacional extends Model
{
    protected $table = 'vinculos_organizacionais';

    protected $fillable = [
        'usuario_id',
        'organizacao_id',
        'cargo',
        'iniciado_em',
        'encerrado_em',
    ];

    protected function casts(): array
    {
        return [
            'iniciado_em' => 'datetime',
            'encerrado_em' => 'datetime',
        ];
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function organizacao(): BelongsTo
    {
        return $this->belongsTo(Organizacao::class, 'organizacao_id');
    }

    public function acessosTerritoriais(): HasMany
    {
        return $this->hasMany(AcessoTerritorial::class, 'vinculo_id');
    }
}
