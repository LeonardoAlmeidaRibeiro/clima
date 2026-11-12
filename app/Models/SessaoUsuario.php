<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SessaoUsuario extends Model
{
    protected $table = 'sessoes_usuario';

    protected $fillable = [
        'usuario_id',
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

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
