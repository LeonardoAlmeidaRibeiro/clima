<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TerritorioHierarquia extends Model
{
    protected $table = 'territorio_hierarquia';

    protected $fillable = [
        'ancestral_id',
        'descendente_id',
        'profundidade',
    ];

    protected function casts(): array
    {
        return [
            'profundidade' => 'integer',
        ];
    }

    public function ancestral(): BelongsTo
    {
        return $this->belongsTo(Territorio::class, 'ancestral_id');
    }

    public function descendente(): BelongsTo
    {
        return $this->belongsTo(Territorio::class, 'descendente_id');
    }
}
