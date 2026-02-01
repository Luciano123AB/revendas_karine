<?php

namespace App\Exports;

use App\Models\Produto;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProdutosExportar implements
    FromCollection,
    WithHeadings
{
    public function collection() {
        return Produto::select("nome", "descricao", "preco", "desconto", "estoque", "categoria_id")->get();
    }

    public function headings(): array {
        return [
            "Nome",
            "Descrição",
            "Preço",
            "Desconto",
            "Estoque",
            "Categoria ID"
        ];
    }
}