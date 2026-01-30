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

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
