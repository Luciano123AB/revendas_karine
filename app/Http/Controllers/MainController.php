<?php

namespace App\Http\Controllers;

use App\Services\Boot;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function inicial() {

        $banco = Boot::testarConexao();
        
        if ($banco == false) {
            Boot::criarPovoarBanco();
        }

        if (!is_dir(base_path("node_modules"))) {
            Boot::dependencias();
        }

        return view("index")->with("pagina", "Início");
    }

    public function home() {
        return view("home")->with("pagina", "Lista");
    }

    public function comprar() {
        return redirect()->back();
    }
}
