<?php

namespace App\Http\Controllers;

use App\Enums\CompraStatus;
use App\Models\Categoria;
use App\Models\Compra;
use App\Models\Produto;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class Admin extends Controller
{
    public function admin() {

        $pedidos = Compra::where("status", "Pendente")
                        ->orderBy("data_compra", "desc")
                        ->get();
        $categorias = Categoria::all();

        return view("admin")
            ->with("pagina", "Administrador")
            ->with("pedidos", $pedidos)
            ->with("categorias", $categorias);
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

        $compra->status = CompraStatus::APROVADO;
        $compra->data_efetuacao = Carbon::now();
        $compra->updated_at = Carbon::now();
        $compra->save();

        return redirect()->back();
    }

    public function novoProduto(Request $request) {
        $request->validate(
            [
                "imagem" => "nullable|url",
                "nome" => "required|string|max:150",
                "descricao" => "nullable|string",
                "preco" => "required|numeric|min:1",
                "desconto" => "nullable|numeric",
                "estoque" => "required|numeric|min:1",
                "categoria" => "required|exists:categorias,id"
            ],

            [
                "imagem.url" => "O campo imagem deve ser um link.",
                "nome.required" => "O campo nome é obrigatório.",
                "nome.string" => "O campo nome deve ser um texto.",
                "nome.max" => "O campo nome deve conter no máximo :max caracteres.",
                "descricao.string" => "O campo descrição deve ser um texto.",
                "preco.required" => "O campo preço é obrigatório.",
                "preco.numeric" => "O campo preco deve conter só números.",
                "preco.min" => "O campo preco deve ser no mínimo :min.",
                "desconto.numeric" => "O campo desconto deve conter só números.",
                "estoque.required" => "O campo estoque é obrigatório.",
                "estoque.numeric" => "O campo estoque deve conter só números.",
                "estoque.min" => "O campo estoque deve ser no mínimo :min.",
                "categoria.required" => "O campo categoria é obrigatório.",
                "categoria.exists" => "Selecione a categoria do produto."
            ]
        );
        
        $imagem = $request->input("imagem");
        $nome = $request->input("nome");
        $descricao = $request->input("descricao");
        $preco = str_replace(',', '.', str_replace('.', '', $request->input("preco")));
        $desconto = $request->input("desconto");
        $estoque = $request->input("estoque");
        $categoria = $request->input("categoria");

        $produto_existe = Produto::where("nome", $nome)
                                ->where("categoria_id", $categoria)
                                ->first();

        if ($produto_existe) {
            return redirect()->back()->withErrors(["existe" => "Esse produto já existe! Tente outro."]);
        }

        $novo_produto = new Produto();

        $novo_produto->imagem = $imagem;
        $novo_produto->nome = $nome;
        $novo_produto->descricao = $descricao;
        $novo_produto->preco = $preco;
        $novo_produto->desconto = $desconto;
        $novo_produto->estoque = $estoque;
        $novo_produto->categoria_id = $categoria;
        
        if (!$novo_produto->save()) {
            return redirect()->back()->withErrors(["falha" => "Falha ao tentar salvar o produto! Tente novamente."]);
        }

        return redirect()->back()->with("sucesso", "Produto salvo com sucesso!");
    }

    public function confirmarResetar() {

        session()->flash("confirmar", [
            "acao" => "resetar"
        ]);

        return redirect()->back();
    }

    public function resetar() {

        $resetar_produtos = Produto::query()->delete();

        if (!$resetar_produtos) {
            return redirect()->back()->withErrors(["falha_resetar" => "Falha ao tentar resetar os produtos! Tente novamente."]);
        }

        return redirect()->back()->with("sucesso_resetar", "Produtos resetados com sucesso!");
    }

    public function pesquisar(Request $request) {
        $request->validate(
            [
                "cliente" => "required|string"
            ],

            [
                "cliente.required" => "O campo cliente é obrigatório.",
                "cliente.string" => "O campo cliente deve ser um texto."
            ]
        );
        
        $cliente_informado = $request->input("cliente");
        $cliente = User::where("name", $cliente_informado)->first();

        if (!$cliente) {
            return redirect()->back()->withErrors(["nao_existe" => "Cliente não encontrado! Tente outro."]);
        }

        $cliente_pedidos = $cliente->compras->where("status", "Pendente");

        return redirect()->back()->with("cliente_pedidos", $cliente_pedidos);
    }
}