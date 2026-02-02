<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable,
        MustVerifyEmailTrait,
        SoftDeletes;

    const UPDATED_AT = null;

    protected $fillable = [
        "permissao",
        "name",
        "email",
        "password",
        "remember_token",
        "telefone",
        "email_verified_at"
    ];

    protected $casts = [
        "permissao" => "boolean",
        "name" => "string",
        "email" => "string",
        "password" => "string",
        "remember_token" => "string",
        "telefone" => "string",
        "email_verified_at" => "datetime"
    ];

    public function compras(): HasMany {
        return $this->hasMany(Compra::class);
    }
}