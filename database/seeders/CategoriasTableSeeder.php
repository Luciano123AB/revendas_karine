<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasTableSeeder extends Seeder
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
    }
}