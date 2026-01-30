<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Produto;
use App\Services\DadosPix;
use App\Services\GerarPayload;
use App\Services\GerarQRCode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class Compras extends Controller
{
    public function escolher($id) {

        $id = Crypt::decrypt($id);
        $produto = Produto::find($id);

        return view("produto")
            ->with("pagina", "Escolha")
            ->with("produto", $produto);
    }

    public function comprar($id, Request $request) {

        $id = Crypt::decrypt($id);
        $produto = Produto::find($id);

        $request->validate(
            [
                'quantidade' => 'required|integer|min:1|max:' . $produto->estoque
            ],

            [
                'quantidade.required' => "O campo quantidade é obrigatório.",
                'quantidade.integer' => "O campo quantidade só deve conter números.",
                'quantidade.min' => "A quantidade deve ser no mínimo :min",
                'quantidade.max' => "A quantidade deve ser no máximo :max"
            ]
        );

        $quantidade = $request->input("quantidade");
        $valor = $produto->preco - ($produto->preco * $produto->desconto / 100);
        $valor_pagar = $valor * $quantidade;

        $nova_compra = new Compra();
        $nova_compra->produto = $produto->nome;
        $nova_compra->quantidade = $quantidade;
        $nova_compra->valor = $valor_pagar;        
        $nova_compra->status = "Pendente";
        $nova_compra->user_id = Auth::user()->id;
        $nova_compra->data_compra = Carbon::now();

        $salvar = DB::transaction(function () use ($nova_compra, $produto, $valor_pagar) {
            $nova_compra->save();

            $dados = $nova_compra->pix = DadosPix::dados($valor_pagar, $nova_compra->id);

            $nova_compra->pix = (new GerarPayload())->gerarPixPayload($dados);
            $nova_compra->save();

            $produto->estoque = $produto->estoque - $nova_compra->quantidade;
            $produto->save();

            return true;
        });

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
}