<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Produto;
use App\Services\GerarQRCode;
use App\Services\Salvar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class Compras extends Controller
{
    public function escolher($id) {

        $id = Crypt::decrypt($id);
        $produto = Produto::find($id);
        $produto->id_crypt = Crypt::encrypt($produto->id);
        $produto->preco_base = number_format($produto->preco, 2, ',', '.');
        $produto->preco_formatado = number_format(
            $produto->preco - ($produto->preco * $produto->desconto / 100),
            2,
            ',',
            '.'
        );

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

        return redirect()->back()->withInput();
    }

    public function comprar($id, $quantidade) {

        $id = Crypt::decrypt($id);
        $produto = Produto::find($id);
        $valor = $produto->preco - ($produto->preco * $produto->desconto / 100);
        $valor_pagar = $valor * $quantidade;
        $nova_compra = new Compra();

        $salvar = Salvar::comprar(
            $nova_compra,
            $quantidade,
            $produto,
            $valor_pagar
        );

        if (!$salvar) {
            session()->flash("resultado", [
                'titulo' => 'ERRO',
                'menssagem' => 'Falha ao comprar o produto! Tente novamente.',
                'icone' => 'error'
            ]);

            return redirect()->back();
        }

        session()->flash("resultado", [
            'titulo' => 'SUCESSO',
            'menssagem' => 'Produto comprado com êxito.',
            'icone' => 'success'
        ]);

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
        $id_produto = $compra->produto_id;
        $produto = Produto::find($id_produto);

        $salvar = Salvar::cancelar($compra, $produto);

        if (!$salvar) {
            session()->flash("resultado", [
                'titulo' => 'ERRO',
                'menssagem' => 'Falha ao cancelar a compra! Tente novamente.',
                'icone' => 'error'
            ]);

            return redirect()->back();
        }

        session()->flash("resultado", [
            'titulo' => 'SUCESSO',
            'menssagem' => 'Compra cancelada com êxito.',
            'icone' => 'success'
        ]);

        return redirect()->back();
    }
}