<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Produto;
use App\Models\User;
use App\Services\Boot;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        $ofertas = Produto::where("desconto", "!=", null)->get();
        $total = Produto::count();

        return view("index")
            ->with("pagina", "Início")
            ->with("ofertas", $ofertas)
            ->with("total", $total);
    }

    public function home() {

        $produtos = Produto::all();
        $total = Produto::count();

        return view("home")
            ->with("pagina", "Lista")
            ->with("produtos", $produtos)
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
        $email_existe = User::where("email", $email)->exists();
        $telefone_existe = User::where("telefone", $telefone)->exists();

        if ($email == $dados->email) {
            $dados->email = $email;
        } else {
            if ($email_existe) {
                return redirect()->back()->withErrors(["email", "Esse email já está sendo usado! Tente outro."]);
            }

            $dados->email = $email;
        }

        if ($telefone == $dados->telefone) {
            $dados->telefone = $telefone;
        } else {
            if ($telefone_existe) {
                return redirect()->back()->withErrors(["telefone", "Esse telefone já está sendo usado! Tente outro."]);                
            }

            $dados->telefone = preg_replace('/\D/', '', $request->telefone);
        }

        $dados->password = Hash::make($senha);
        $dados->updated_at = Carbon::now();

        if (!$dados->save()) {
            return redirect()->back()->withErrors(["falha", "Falha ao atualizar os dados! Tente novamente."]);
        }

        return redirect()->back()->with("sucesso", "Dados atualizados com sucesso!");
    }

    public function pedidos() {

        $id = Auth::user()->id;
        $cliente = User::find($id);
        $pedidos = $cliente->compras->where("status", "Pendente");

        return view("pedidos")
            ->with("pagina", "Pedidos")
            ->with("pedidos", $pedidos);
    }

    public function historico() {

        $id = Auth::user()->id;
        $cliente = User::find($id);
        $compras = $cliente->compras->whereNotIn("status", ["Pendente"]);

        return view("historico")
            ->with("pagina", "Histórico")
            ->with("compras", $compras);
    }

    public function admin() {

        $pedidos = Compra::all()->where("status", "==", "Pendente");

        return view("admin")
            ->with("pagina", "Administrador")
            ->with("pedidos", $pedidos);
    }
}