<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AcessoAcompanhamento extends Model
{
    protected $table = 'acessos_acompanhamento';

    protected $fillable = [
        'ocorrencia_id',
        'token_hash',
        'expira_em',
    ];

    protected $hidden = ['token_hash'];

    protected function casts(): array
    {
        return [
            'expira_em' => 'datetime',
        ];
    }

    public function ocorrencia(): BelongsTo
    {
        return $this->belongsTo(Ocorrencia::class, 'ocorrencia_id');
    }
}
