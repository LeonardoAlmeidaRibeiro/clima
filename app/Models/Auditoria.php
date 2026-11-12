<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Auditoria extends Model
{
    protected $table = 'auditorias';

    protected $fillable = [
        'usuario_id',
        'territorio_id',
        'evento',
        'entidade',
        'entidade_id',
    ];

    protected function casts(): array
    {
        return [
            'entidade_id' => 'integer',
        ];
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function territorio(): BelongsTo
    {
        return $this->belongsTo(Territorio::class, 'territorio_id');
    }
}
