<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Registros extends Controller
{
    public function pedidos() {

        $id = Auth::user()->id;
        $cliente = User::find($id);
        $pedidos = $cliente->compras->where("status", "Pendente");

        return view("pedidos")
            ->with("pagina", "Pedidos")
            ->with("pedidos", $pedidos);
    }

    public function historico() {

        $id = Auth::user()->id;
        $cliente = User::find($id);
        $compras = $cliente->compras->whereNotIn("status", ["Pendente"]);

        return view("historico")
            ->with("pagina", "Histórico")
            ->with("compras", $compras);
    }
}