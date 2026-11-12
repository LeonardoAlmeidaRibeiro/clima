<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PessoaContato extends Model
{
    protected $table = 'pessoa_contatos';

    protected $fillable = [
        'pessoa_id',
        'tipo',
        'valor_cifrado',
    ];

    protected $hidden = ['valor_cifrado'];

    protected function casts(): array
    {
        return [
            'valor_cifrado' => 'encrypted',
        ];
    }

    public function pessoa(): BelongsTo
    {
        return $this->belongsTo(Pessoa::class, 'pessoa_id');
    }
}
