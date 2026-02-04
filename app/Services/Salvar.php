<?php

namespace App\Services;

use App\Enums\CompraStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Salvar
{
    public static function comprar($nova_compra, int $quantidade, $produto, float $valor_pagar) {
        $nova_compra->quantidade = $quantidade;
        $nova_compra->valor = $valor_pagar;
        $nova_compra->status = CompraStatus::PENDENTE;
        $nova_compra->produto_id = $produto->id;
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

        return $salvar;
    }
}