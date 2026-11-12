<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContatoOcorrencia extends Model
{
    protected $table = 'contatos_ocorrencia';

    protected $fillable = [
        'ocorrencia_id',
        'nome_cifrado',
        'email_cifrado',
        'telefone_cifrado',
    ];

    protected $hidden = ['nome_cifrado', 'email_cifrado', 'telefone_cifrado'];

    protected function casts(): array
    {
        return [
            'nome_cifrado' => 'encrypted',
            'email_cifrado' => 'encrypted',
            'telefone_cifrado' => 'encrypted',
        ];
    }

    public function ocorrencia(): BelongsTo
    {
        return $this->belongsTo(Ocorrencia::class, 'ocorrencia_id');
    }
}
