<?php

namespace App\Http\Controllers;

use App\Enums\CompraStatus;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class Registros extends Controller
{
    public function pedidos() {

        $id = Auth::user()->id;
        $cliente = User::find($id);
        $pedidos = $cliente->compras()->where("status", CompraStatus::PENDENTE)
                                    ->get()
                                    ->map(function ($pedido) {
                                        $pedido->id_crypt = Crypt::encrypt($pedido->id);
                                        $pedido->valor_formatado = number_format(
                                            $pedido->valor,
                                            2,
                                            ',',
                                            '.'
                                        );

                                        return $pedido;
                                    });

        return view("registros.pedidos")
            ->with("pagina", "Pedidos")
            ->with("pedidos", $pedidos);
    }

    public function historico() {

        $id = Auth::user()->id;
        $cliente = User::find($id);
        $compras = $cliente->compras()->where('status', '!=', CompraStatus::PENDENTE)
                                    ->get()
                                    ->map(function ($compra) {
                                        $compra->id_crypt = Crypt::encrypt($compra->id);
                                        $compra->valor_formatado = number_format(
                                            $compra->valor,
                                            2,
                                            ',',
                                            '.'
                                        );

                                        return $compra;
                                    });

        return view("registros.historico")
            ->with("pagina", "Histórico")
            ->with("compras", $compras);
    }
}