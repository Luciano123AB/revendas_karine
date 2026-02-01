<?php

namespace App\Http\Controllers;

use App\Exports\ProdutosExportar;
use App\Imports\ProdutosImportar;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelExcel;

class Produtos extends Controller
{
    public function importar(Request $request) {
        $request->validate([
            "arquivo" => "required"
        ],
    
        [
            "arquivo.required" => "O campo arquivo é obrigatório.",
        ]);

        $importar = Excel::import(
            new ProdutosImportar,
            $request->file("arquivo"),
            null,
            ExcelExcel::XLSX
        );

        if (!$importar) {
            return redirect()->back()->withErrors("falha_importar", "Falha ao tentar importar os produtos! Tente novamente.");
        }

        return redirect()->back()->with("sucesso_importar", "Dados importados com sucesso!");;
    }

    public function exportar() {
        try {
            return Excel::download(new ProdutosExportar, 'produtos.xlsx');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors("falha_exportar", "Falha ao tentar exportar os produtos! Tente novamente.");
        }
    }
}