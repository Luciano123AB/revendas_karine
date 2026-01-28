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
            ["nome" => "Eletrônicos"],
            ["nome" => "Moda & Acessórios"],
            ["nome" => "Casa & Decoração"],
            ["nome" => "Beleza & Cuidados Pessoais"],
            ["nome" => "Saúde & Bem-estar"],
            ["nome" => "Esporte & Lazer"],
            ["nome" => "Infantil & Bebês"],
            ["nome" => "Automotivo"],
            ["nome" => "Papelaria & Escritório"],
            ["nome" => "Pet Shop"],
            ["nome" => "Alimentos & Bebidas"],
            ["nome" => "Ferramentas & Construção"],
            ["nome" => "Games & Consoles"],
            ["nome" => "Livros & Mídia"],
            ["nome" => "Presentes & Utilidades"],
            ["nome" => "Informática"],
            ["nome" => "Celulares & Smartphones"],
            ["nome" => "Áudio & Vídeo"],
            ["nome" => "Móveis"],
            ["nome" => "Cama, Mesa & Banho"],
            ["nome" => "Cozinha"],
            ["nome" => "Iluminação"],
            ["nome" => "Organização"],
            ["nome" => "Acessórios"],
            ["nome" => "Calçados"],
            ["nome" => "Promoções"],
            ["nome" => "Lançamentos"],
            ["nome" => "Mais Vendidos"],
        ]);
    }
}