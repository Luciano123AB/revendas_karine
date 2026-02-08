<?php

namespace Database\Seeders;

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
            ["nome" => "Moda e Acessórios"],
            ["nome" => "Eletrônicos"],
            ["nome" => "Casa e Decoração"],
            ["nome" => "Eletrodomésticos"],
            ["nome" => "Beleza e Cuidados Pessoais"],
            ["nome" => "Brinquedos e Jogos"],
            ["nome" => "Esporte e Lazer"],
            ["nome" => "Livros, Papelaria e Escritório"],
            ["nome" => "Pet Shop"],
            ["nome" => "Automotivo"],
            ["nome" => "Ferramentas e Construção"],
            ["nome" => "Presentes e Utilidades"],
            ["nome" => "Saúde e Bem-estar"]
        ]);
    }
}