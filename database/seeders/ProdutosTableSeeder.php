<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdutosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = DB::table('categorias')->get();
        $produtos = [];

        foreach ($categorias as $categoria) {
            for ($i = 1; $i <= 5; $i++) {

                $tem_desconto = $i <= 2;
                $preco = rand(50, 500);

                $produtos[] = [
                    'nome' => $categoria->nome . ' Produto ' . $i,
                    'descricao' => 'Descrição do produto ' . $i . ' da categoria ' . $categoria->nome,
                    'preco' => $preco,
                    'desconto' => $tem_desconto ? rand(5, 30) : 0,
                    'estoque' => rand(10, 200),
                    'categoria_id' => $categoria->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('produtos')->insert($produtos);
    }
}