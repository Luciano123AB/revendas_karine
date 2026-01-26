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

        $input['phone'] = preg_replace('/\D/', '', $input['phone']);
        
        Validator::make($input, [
            'name' => [
                'required',
                'string',
                'max:120',
                Rule::unique(User::class)
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class)
            ],
            'password' => $this->passwordRules(),
            'password_confirmation' => 'required',
            'phone' => [
                'required',
                'regex:/^\d{10,11}$/',
                Rule::unique(User::class)
            ]
        ], [
            "name.required" => "O campo nome é obrigatório.",
            "name.max" => "O campo nome deve ter no máximo 120 caracteres.",
            "name.unique" => "O nome informado já está em uso.",
            "email.required" => "O campo email é obrigatório.",
            "email.max" => "O campo email deve ter no máximo 255 caracteres.",
            "email.email" => "O campo email deve ser um endereço de email válido.",
            "email.unique" => "O email informado já está em uso.",
            "password.required" => "O campo senha é obrigatório.",
            "password.min" => "O campo senha deve ter no mínimo 8 caracteres.",
            "password.letters" => "O campo senha deve conter pelo menos uma letra.",
            "password.numbers" => "O campo senha deve conter pelo menos um número.",
            "password.confirmed" => "A confirmação da senha não corresponde.",
            "password_confirmation.required" => "O campo de confirmação de senha é obrigatório.",
            "phone.required" => "O campo telefone é obrigatório.",
            "phone.regex" => "O telefone deve conter 10 ou 11 números.",
            "phone.unique" => "O telefone informado já está em uso."
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'phone' => $input['phone']
        ]);
    }
}
