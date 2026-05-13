<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("categorias")->insert([
            ["nome" => "Moda e Acessórios", "created_at" => Carbon::now()],
            ["nome" => "Eletrônicos", "created_at" => Carbon::now()],
            ["nome" => "Casa e Decoração", "created_at" => Carbon::now()],
            ["nome" => "Eletrodomésticos", "created_at" => Carbon::now()],
            ["nome" => "Beleza e Cuidados Pessoais", "created_at" => Carbon::now()],
            ["nome" => "Brinquedos e Jogos", "created_at" => Carbon::now()],
            ["nome" => "Esporte e Lazer", "created_at" => Carbon::now()],
            ["nome" => "Livros, Papelaria e Escritório", "created_at" => Carbon::now()],
            ["nome" => "Pet Shop", "created_at" => Carbon::now()],
            ["nome" => "Automotivo", "created_at" => Carbon::now()],
            ["nome" => "Ferramentas e Construção", "created_at" => Carbon::now()],
            ["nome" => "Presentes e Utilidades", "created_at" => Carbon::now()],
            ["nome" => "Saúde e Bem-estar", "created_at" => Carbon::now()]
        ]);

        DB::table("users")->insert([
            [
                "permissao" => true,
                "name" => "Admin",
                "email" => "admin@gmail.com",
                "password" => Hash::make("24032004ABcd123"),
                "telefone" => "55999999999",
                "email_verified_at" => Carbon::now(),
                "created_at" => Carbon::now()
            ],

            [
                "permissao" => false,
                "name" => "Luciano123AB",
                "email" => "luciano@gmail.com",
                "password" => Hash::make("24032004ABcd123"),
                "telefone" => "55999999998",
                "email_verified_at" => Carbon::now(),
                "created_at" => Carbon::now()
            ]
        ]);
    }
}