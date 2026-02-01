<?php

namespace App\Imports;

use App\Models\Produto;
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

        return new Produto([
            "imagem" => $row["imagem"],
            "nome" => $row["nome"],
            "descricao" => $row["descricao"],
            "preco" => $row["preco"],
            "desconto" => $row["desconto"],
            "estoque" => $row["estoque"],
            "categoria_id" => $row["categoria_id"],
            "created_at" => date("Y-m-d"),
            "updated_at" => null
        ]);
    }
}