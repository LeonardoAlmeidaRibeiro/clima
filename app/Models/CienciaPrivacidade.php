<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CienciaPrivacidade extends Model
{
    protected $table = 'ciencias_privacidade';

    protected $fillable = [
        'aviso_id',
        'usuario_id',
        'ocorrencia_id',
        'registrado_em',
    ];

    protected function casts(): array
    {
        return [
            'registrado_em' => 'datetime',
        ];
    }

    public function aviso(): BelongsTo
    {
        return $this->belongsTo(VersaoAvisoPrivacidade::class, 'aviso_id');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function ocorrencia(): BelongsTo
    {
        return $this->belongsTo(Ocorrencia::class, 'ocorrencia_id');
    }
}
