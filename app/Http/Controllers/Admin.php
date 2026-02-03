<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Compra;
use App\Models\Produto;
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

        $compra->status = "Aprovado";
        $compra->data_efetuacao = Carbon::now();
        $compra->updated_at = Carbon::now();
        $compra->save();

        return redirect()->back();
    }

    public function novoProduto(Request $request) {
        $request->validate(
            [
                "nome" => "required",
                "preco" => "required",
                "estoque" => "required",
                "categoria" => "required"
            ],

            [
                "nome.required" => "O campo nome é obrigatório.",
                "preco.required" => "O campo preço é obrigatório.",
                "estoque.required" => "O campo estoque é obrigatório.",
                "categoria.required" => "O campo categoria é obrigatório."
            ]
        );

        $categoria = $request->input("categoria");

        if ($categoria == "Selecione") {
            return redirect()->back()->withErrors(["categoria" => "Selecione a categoria do produto."]);
        }
        
        $imagem = $request->input("imagem");
        $nome = $request->input("nome");
        $descricao = $request->input("descricao");
        $preco = str_replace(',', '.', str_replace('.', '', $request->input("preco")));
        $desconto = $request->input("desconto");
        $estoque = $request->input("estoque");

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
}