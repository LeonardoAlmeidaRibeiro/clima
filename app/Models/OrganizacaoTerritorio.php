<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrganizacaoTerritorio extends Model
{
    protected $table = 'organizacao_territorios';

    protected $fillable = [
        'organizacao_id',
        'territorio_id',
        'inclui_descendentes',
    ];

    protected function casts(): array
    {
        return [
            'inclui_descendentes' => 'boolean',
        ];
    }

    public function organizacao(): BelongsTo
    {
        return $this->belongsTo(Organizacao::class, 'organizacao_id');
    }

    public function territorio(): BelongsTo
    {
        return $this->belongsTo(Territorio::class, 'territorio_id');
    }
}
