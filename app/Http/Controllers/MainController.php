<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Services\Boot;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function inicio() {

        $banco = Boot::testarConexao();
        
        if ($banco == false) {
            Boot::criarPovoarBanco();
        }

        if (!is_dir(base_path("node_modules"))) {
            Boot::dependencias();
        }

        $ofertas = Produto::where("desconto", ">", 0)->get();
        $total = Produto::count();

        return view("index")
            ->with("pagina", "Início")
            ->with("ofertas", $ofertas)
            ->with("total", $total);
    }

    public function home() {

        $produtos = Produto::all();
        $total = Produto::count();

        return view("home")
            ->with("pagina", "Lista")
            ->with("produtos", $produtos)
            ->with("total", $total);
    }

    public function historico() {
        return redirect()->back();
    }
}