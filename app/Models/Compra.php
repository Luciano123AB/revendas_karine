<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Compra extends Model
{
    use SoftDeletes;

    const UPDATED_AT = null;

    protected $fillable = [
        "quantidade",
        "valor",
        "pix",
        "status",
        "produto_id",
        "user_id",
        "data_compra",
        "data_efetuacao"
    ];

    protected $casts = [
        "quantidade" => "integer",
        "valor" => "float",
        "pix" => "string",
        "status" => "string",
        "produto_id" => "integer",
        "user_id" => "integer",
        "data_compra" => "datetime",
        "data_efetuacao" => "datetime"
    ];

    public function produto(): BelongsTo {
        return $this->belongsTo(Produto::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}