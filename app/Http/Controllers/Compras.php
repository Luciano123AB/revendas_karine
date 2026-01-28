<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class Compras extends Controller
{
    public function escolher($id) {

        $id = Crypt::decrypt($id);
        $produto = Produto::find($id);

        return view("produto")
            ->with("pagina", "Escolha")
            ->with("produto", $produto);
    }

    public function comprar() {
        return redirect()->back();
    }
}