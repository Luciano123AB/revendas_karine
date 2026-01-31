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
        "produto",
        "quantidade",
        "valor",
        "pix",
        "status",
        "user_id",
        "data_compra",
        "data_efetuacao"
    ];

    protected $casts = [
        "produto" => "string",
        "quantidade" => "integer",
        "valor" => "float",
        "pix" => "string",
        "status" => "string",
        "user_id" => "integer",
        "data_compra" => "datetime",
        "data_efetuacao" => "datetime"
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
