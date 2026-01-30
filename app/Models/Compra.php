<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Compra extends Model
{
    use SoftDeletes;

    protected $fillable = [
        "produto",
        "quantidade",
        "valor",
        "pix",
        "status",
        "user_id",
        "data_compra"
    ];

    protected $casts = [
        "produto" => "string",
        "quantidade" => "integer",
        "valor" => "float",
        "pix" => "string",
        "status" => "string",
        "user_id" => "integer",
        "data_compra" => "datetime"
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
