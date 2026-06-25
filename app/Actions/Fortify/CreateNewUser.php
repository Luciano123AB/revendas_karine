<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {

        $input['telefone'] = preg_replace('/\D/', '', $input['telefone']);
        
        Validator::make($input, [
            'name' => [
                'required',
                'string',
                'max:120',
                Rule::unique(User::class)
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique(User::class)
            ],
            'password' => $this->passwordRules(),
            'password_confirmation' => 'required',
            'telefone' => [
                'required',
                'regex:/^\d{10,11}$/',
                Rule::unique(User::class)
            ]
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'telefone' => $input['telefone']
        ]);
    }
}