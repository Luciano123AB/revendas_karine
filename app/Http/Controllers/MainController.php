<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Compra;
use App\Models\Produto;
use App\Models\User;
use App\Services\Boot;
use App\Services\Salvar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class MainController extends Controller
{
    public function inicio() {

        $banco = Boot::testarConexao();
        
        if ($banco == false) {
            Boot::criarPovoarBanco();
        }

        if (!is_dir(base_path("node_modules"))) {
            Boot::dependencias();
        }

        $ofertas = Produto::where("desconto", "!=", null)
                            ->orderBy("nome")
                            ->get();
        $total = $ofertas->where("desconto", ">", 0)->count();

        return view("index")
            ->with("pagina", "Início")
            ->with("ofertas", $ofertas)
            ->with("total", $total);
    }

    public function home($categoria) {

        $produtos = null;

        if ($categoria == "Todos") {
            $produtos = Produto::orderBy("nome")->get();
        } else {
            $produtos = Produto::whereRelation("categoria", "nome", $categoria)
                                ->orderBy("nome")
                                ->get();
        }

        $categorias = Categoria::where("nome", "!=", $categoria)->get();
        $total = $produtos->count();

        return view("home")
            ->with("pagina", "Lista")
            ->with("produtos", $produtos)
            ->with("categoria", $categoria)
            ->with("categorias", $categorias)
            ->with("total", $total);
    }

    public function editar() {

        $dados = Auth::user();

        return view("atualizar")
            ->with("pagina", "Atualizar Dados")
            ->with("dados", $dados);
    }

    public function atualizar(Request $request) {
        $request->validate(
            [
                "email" => "required|email",
                "telefone" => "required|min:10",
                "senha" => "required|min:8|confirmed"
            ],

            [
                "email.required" => "O campo email é obrigatório.",
                "email.email" => "O campo email deve ser um endereço de email.",
                "telefone.required" => "O campo telefone é obrigatório.",
                "telefone.min" => "O campo telefone deve ter no mínimo 10 caracteres.",
                "senha.required" => "O campo senha é obrigatório.",
                "senha.min" => "O campo senha deve ter no mínimo 8 caracteres.",
                "senha_confirmation.required" => "O campo confirmar senha é obrigatório."
            ]
        );

        $dados = Auth::user();
        $email = $request->input("email");
        $senha = $request->input("senha");
        $telefone = $request->input("telefone");
        $email_existe = User::where("email", $email)
                            ->where("id", "!=", $dados->id)
                            ->exists();
        $telefone_existe = User::where("telefone", preg_replace('/\D/', '', $telefone))
                                ->where("id", "!=", $dados->id)
                                ->exists();

        $salvar = Salvar::atualizar(
            $dados,
            $email,
            $senha,
            $telefone,
            $email_existe,
            $telefone_existe
        );

        if (!$salvar) {
            return redirect()->back()->withErrors(["falha", "Falha ao atualizar os dados! Tente novamente."]);
        }

        return redirect()->back()->with("sucesso", "Dados atualizados com sucesso!");
    }

    public function apagar($id) {

        $id = Crypt::decrypt($id);
        $compra = Compra::find($id);

        $compra->delete();

        return redirect()->back();
    }    
}