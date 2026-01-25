<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, MustVerifyEmailTrait;

    protected $fillable = [
        "name",
        "email",
        "password",
        "phone",
    ];

    public function compras(): HasMany {
        return $this->hasMany(Compra::class);
    }
}