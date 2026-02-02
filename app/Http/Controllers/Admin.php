<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

class Admin extends Controller
{
    public function admin() {

        $pedidos = Compra::where("status", "Pendente")
                        ->orderBy("data_compra", "desc")
                        ->get();

        return view("admin")
            ->with("pagina", "Administrador")
            ->with("pedidos", $pedidos);
    }

    public function confirmarAprovar($id) {

        session()->flash("confirmar", [
            "acao" => "aprovar",
            "id" => $id
        ]);

        return redirect()->back();
    }

    public function aprovar($id) {

        $id = Crypt::decrypt($id);
        $compra = Compra::find($id);

        $compra->status = "Aprovado";
        $compra->data_efetuacao = Carbon::now();
        $compra->updated_at = Carbon::now();
        $compra->save();

        return redirect()->back();
    }
}