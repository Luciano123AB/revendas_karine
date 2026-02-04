<?php

namespace App\Http\Controllers;

use App\Enums\CompraStatus;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Registros extends Controller
{
    public function pedidos() {

        $id = Auth::user()->id;
        $cliente = User::find($id);
        $pedidos = $cliente->compras->where("status", CompraStatus::PENDENTE);

        return view("registros.pedidos")
            ->with("pagina", "Pedidos")
            ->with("pedidos", $pedidos);
    }

    public function historico() {

        $id = Auth::user()->id;
        $cliente = User::find($id);
        $compras = $cliente->compras()->where('status', '!=', CompraStatus::PENDENTE)->get();

        return view("registros.historico")
            ->with("pagina", "Histórico")
            ->with("compras", $compras);
    }
}