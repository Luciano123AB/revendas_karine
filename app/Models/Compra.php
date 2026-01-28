<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Compra extends Model
{
    use SoftDeletes;

    protected $fillable = [
        "quantidade",
        "preco",
        "data_compra",
        "status",
        "produto_id",
        "user_id"
    ];

    public function produto(): BelongsTo {
        return $this->belongsTo(Produto::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
