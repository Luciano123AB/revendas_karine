<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Produto;
use App\Services\GerarQRCode;
use App\Services\Salvar;
use Carbon\Carbon;
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

    public function confirmarComprar($id, $estoque, Request $request) {
        $request->validate(
            [
                'quantidade' => 'required|integer|min:1|max:' . $estoque
            ],

            [
                'quantidade.required' => "O campo quantidade é obrigatório.",
                'quantidade.integer' => "O campo quantidade só deve conter números.",
                'quantidade.min' => "A quantidade deve ser no mínimo :min",
                'quantidade.max' => "A quantidade deve ser no máximo :max"
            ]
        );

        $quantidade = $request->input("quantidade");

        session()->flash("confirmar", [
            "acao" => "comprar",
            "id" => $id,
            "quantidade" => $quantidade
        ]);

        return redirect()->back();
    }

    public function comprar($id, $quantidade) {

        $id = Crypt::decrypt($id);
        $produto = Produto::find($id);
        $valor = $produto->preco - ($produto->preco * $produto->desconto / 100);
        $valor_pagar = $valor * $quantidade;
        $nova_compra = new Compra();

        $salvar = Salvar::comprar($nova_compra, $quantidade, $produto, $valor_pagar);

        if (!$salvar) {
            return redirect()->back()->withErrors(['falha' => 'Falha ao realizar a compra! Tente novamente.']);
        }

        return redirect()->route("qrcode", ["id" => Crypt::encrypt($nova_compra->id)]);
    }

    public function qrcode($id) {

        $id = Crypt::decrypt($id);
        $compra = Compra::find($id);
        $qrcode = (new GerarQRCode())->gerar($compra->valor, $compra->id);

        return view("pix", ["qrcode" => $qrcode])->with("pagina", "Pagamento");
    }

    public function confirmarCancelar($id) {

        session()->flash("confirmar", [
            "acao" => "cancelar",
            "id" => $id
        ]);

        return redirect()->back();
    }

    public function cancelarCompra($id) {

        $id = Crypt::decrypt($id);
        $compra = Compra::find($id);

        $compra->status = "Cancelado";
        $compra->data_efetuacao = Carbon::now();
        $compra->updated_at = Carbon::now();
        $compra->save();

        $id_produto = $compra->produto_id;
        $produto = Produto::find($id_produto);

        $produto->estoque = $produto->estoque + 1;
        $produto->save();

        return redirect()->back();
    }    
}