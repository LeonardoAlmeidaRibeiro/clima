<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AcessoTerritorial extends Model
{
    protected $table = 'acessos_territoriais';

    protected $fillable = [
        'vinculo_id',
        'papel_id',
        'territorio_id',
        'concedido_por_id',
        'inclui_descendentes',
        'expira_em',
        'revogado_em',
    ];

    protected function casts(): array
    {
        return [
            'inclui_descendentes' => 'boolean',
            'expira_em' => 'datetime',
            'revogado_em' => 'datetime',
        ];
    }

    public function vinculo(): BelongsTo
    {
        return $this->belongsTo(VinculoOrganizacional::class, 'vinculo_id');
    }

    public function papel(): BelongsTo
    {
        return $this->belongsTo(Papel::class, 'papel_id');
    }

    public function territorio(): BelongsTo
    {
        return $this->belongsTo(Territorio::class, 'territorio_id');
    }

    public function concedidoPor(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'concedido_por_id');
    }
}
