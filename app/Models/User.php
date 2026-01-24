<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model implements MustVerifyEmail
{
    protected $fillable = [
        "name",
        "email",
        "password",
        "data_nascimento",
        "foto",
        "permissao",
        "ultimo_acesso"
    ];
    
    public function notas(): HasMany {
        return $this->hasMany(Nota::class);
    }
}
