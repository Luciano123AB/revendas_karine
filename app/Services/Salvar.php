<?php

namespace App\Services;

use App\Enums\CompraStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

    public static function cancelar($compra, $produto) {
        try {
            DB::transaction(function () use ($compra, $produto) {
                $compra->status = CompraStatus::CANCELADO;
                $compra->data_efetuacao = Carbon::now();
                $compra->updated_at = Carbon::now();

                $produto->estoque += $compra->quantidade;

                $compra->saveOrFail();
                $produto->saveOrFail();
            });

            return true;
        } catch (\Throwable $e) {
            return false;
        }
    }

    public static function atualizar($dados, $email, $senha, $telefone, $email_existe, $telefone_existe) {
        try {            
            if ($email !== $dados->email) {
                if ($email_existe) {
                    session()->flash("email", "Esse email já está sendo usado! Tente outro.");

                    return false;
                }
            }

            $telefone = preg_replace('/\D/', '', $telefone);

            if ($telefone !== $dados->telefone) {
                if ($telefone_existe) {
                    session()->flash("telefone", "Esse telefone já está sendo usado! Tente outro.");

                    return false;
                }
            }

            DB::transaction(function () use ($dados, $email, $senha, $telefone) {
                $dados->email = $email;
                $dados->telefone = $telefone;
                $dados->password = Hash::make($senha);
                $dados->updated_at = Carbon::now();
                $dados->saveOrFail();
            });

            return true;
        } catch (\Throwable $e) {
            return false;
        }
    }

    public static function aprovar($compra) {
        try {
            DB::transaction(function () use ($compra) {
                $compra->status = CompraStatus::APROVADO;
                $compra->data_efetuacao = Carbon::now();
                $compra->updated_at = Carbon::now();
                $compra->saveOrFail();
            });

            return true;
        } catch (\Throwable $e) {
            return false;
        }
    }

    public static function novoProduto($imagem, $nome, $descricao, $preco, $desconto, $estoque, $categoria, $novo_produto) {
        try {
            DB::transaction(function () use ($imagem, $nome, $descricao, $preco, $desconto, $estoque, $categoria, $novo_produto) {
                $novo_produto->imagem = $imagem;
                $novo_produto->nome = $nome;
                $novo_produto->descricao = $descricao;
                $novo_produto->preco = $preco;
                $novo_produto->desconto = $desconto;
                $novo_produto->estoque = $estoque;
                $novo_produto->categoria_id = $categoria;

                $novo_produto->saveOrFail();
            });

            return true;
        } catch (\Throwable $e) {
            return false;
        }
    }
}