<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nome',
        'descricao',
        'preco',
        'desconto',
        'categoria_id',
        'estoque'
    ];

    public function categoria(): BelongsTo {
        return $this->belongsTo(Categoria::class);
    }
}
