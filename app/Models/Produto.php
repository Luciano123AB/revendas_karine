<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use SoftDeletes;

    const UPDATED_AT = null;

    protected $fillable = [
        'imagem',
        'nome',
        'descricao',
        'preco',
        'desconto',
        'estoque',
        'categoria_id'
    ];

    protected $casts = [
        "imagem" => "string",
        "nome" => "string",
        "descricao" => "string",
        "preco" => "decimal:2",
        "desconto" => "integer",
        "estoque" => "integer",
        "categoria_id" => "integer"
    ];

    public function categoria(): BelongsTo {
        return $this->belongsTo(Categoria::class);
    }
}