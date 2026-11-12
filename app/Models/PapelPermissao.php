<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PapelPermissao extends Model
{
    protected $table = 'papel_permissoes';

    protected $fillable = [
        'papel_id',
        'permissao_id',
    ];

    public function papel(): BelongsTo
    {
        return $this->belongsTo(Papel::class, 'papel_id');
    }

    public function permissao(): BelongsTo
    {
        return $this->belongsTo(Permissao::class, 'permissao_id');
    }
}
