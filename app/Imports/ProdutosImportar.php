<?php

namespace App\Imports;

use App\Models\Produto;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class ProdutosImportar implements
    ToModel,
    WithHeadingRow,
    SkipsEmptyRows
{
    public function model(array $row) {
        if (empty($row["nome"]) &&
            empty($row["preco"]) &&
            empty($row["estoque"]) &&
            empty($row["categoria_id"])
        ) {
            return null;
        }

        $produto = Produto::where('nome', $row['nome'])
                        ->where('categoria_id', $row['categoria_id'])
                        ->first();

        if (!$produto) {
            return new Produto(
                [
                    'imagem' => $row['imagem'] ?? null,
                    'nome' => $row["nome"],
                    'descricao' => $row['descricao'] ?? null,
                    'preco' => $row['preco'],
                    'desconto' => $row['desconto'] ?? null,
                    'estoque' => $row['estoque'],
                    'categoria_id' => $row["categoria_id"]
                ]
            );
        }

        $produto->fill([
            'imagem' => $row['imagem'] ?? null,
            'descricao' => $row['descricao'] ?? null,
            'preco' => $row['preco'],
            'desconto' => $row['desconto'] ?? null,
            'estoque' => $row['estoque'],
        ]);

        $produto->updated_at = Carbon::now();
        $produto->save();

        return null;
    }
}