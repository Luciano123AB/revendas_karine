<?php

namespace App\Http\Controllers;

use App\Enums\CompraStatus;
use App\Models\Categoria;
use App\Models\Compra;
use App\Models\Produto;
use App\Models\User;
use App\Services\Boot;
use App\Services\Salvar;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class MainController extends Controller
{
    public function inicio(): View {
        if (Boot::testarConexao() == false) {
            Boot::criarPovoarBanco();
        }

        if (!is_dir(base_path('node_modules'))) {
            Boot::dependencias();
        }

        $ofertas = Produto::where('desconto', '!=', null)
                            ->orderBy('nome')
                            ->get()
                            ->map(function ($oferta) {
                                $oferta->id_crypt = Crypt::encrypt($oferta->id);
                                $oferta->preco_base = number_format(
                                    $oferta->preco,
                                    2,
                                    ',',
                                    '.'
                                );
                                $oferta->preco_formatado = number_format(
                                    $oferta->preco - ($oferta->preco * $oferta->desconto / 100),
                                    2,
                                    ',',
                                    '.'
                                );

                                return $oferta;
                            });
        $total = $ofertas->where('desconto', '>', 0)->count();

        return view('index')
            ->with('pagina', 'Início')
            ->with('ofertas', $ofertas)
            ->with('total', $total);
    }

    public function home($categoria): View {

        $produtos = null;

        if ($categoria == 'Todos') {
            $produtos = Produto::orderBy('nome')
                                ->get()
                                ->map(function ($produto) {
                                    $produto->id_crypt = Crypt::encrypt($produto->id);
                                    $produto->preco_base = number_format(
                                        $produto->preco,
                                        2,
                                        ',',
                                        '.'
                                    );
                                    $produto->preco_formatado = number_format(
                                        $produto->preco - ($produto->preco * $produto->desconto / 100),
                                        2,
                                        ',',
                                        '.'
                                    );

                                    return $produto;
                                });
        } else {
            $produtos = Produto::whereRelation('categoria', 'nome', $categoria)
                                ->orderBy('nome')
                                ->get()
                                ->map(function ($produto) {
                                    $produto->id_crypt = Crypt::encrypt($produto->id);
                                    $produto->preco_base = number_format(
                                        $produto->preco,
                                        2,
                                        ',',
                                        '.'
                                    );
                                    $produto->preco_formatado = number_format(
                                        $produto->preco - ($produto->preco * $produto->desconto / 100),
                                        2,
                                        ',',
                                        '.'
                                    );

                                    return $produto;
                                });
        }

        $categorias = Categoria::where('nome', '!=', $categoria)->get();
        $total = $produtos->count();

        return view('home')
            ->with('pagina', 'Lista')
            ->with('produtos', $produtos)
            ->with('categoria', $categoria)
            ->with('categorias', $categorias)
            ->with('total', $total);
    }

    public function atualizarConta(): View {

        $dados = Auth::user();

        return view('atualizar')
            ->with('pagina', 'Atualizar Dados')
            ->with('dados', $dados);
    }

    public function atualizar(Request $request): RedirectResponse {
        $request->merge([
            'telefone' => preg_replace('/\D/', '', $request->telefone)
        ]);

        $request->validate(
            [
                'email' => 'required|email|max:255',
                'telefone' => 'required|regex:/^\d{10,11}$/'
            ],

            [
                'email.required' => 'O campo email é obrigatório.',
                'email.email' => 'O campo email deve ser um endereço de email válido.',
                'email.max' => 'O campo email deve ter no máximo :max caracteres.',
                'telefone.required' => 'O campo telefone é obrigatório.',
                'telefone.regex' => 'O telefone deve conter 10 ou 11 números.'
            ]
        );

        $dados = Auth::user();
        $email = $request->input('email');
        $telefone = preg_replace('/\D/', '', $request->input('telefone'));
        $email_existe = User::where('email', $email)
                            ->where('id', '!=', $dados->id)
                            ->exists();
        $telefone_existe = User::where('telefone', $telefone)
                                ->where('id', '!=', $dados->id)
                                ->exists();

        $salvar = Salvar::atualizar(
            $dados,
            $email,
            $telefone,
            $email_existe,
            $telefone_existe
        );

        if (!$salvar) {
            return redirect()->back()->withErrors(['falha', 'Falha ao atualizar os dados! Tente novamente.']);
        }

        return redirect()->back()->with('sucesso', 'Dados atualizados com sucesso!');
    }

    public function redefinirSenha(): View {
        return view('auth.redefinir_senha')->with('pagina', 'Redefinir Senha');
    }

    public function redefinir(Request $request): RedirectResponse {
        $request->validate(
            [
                'senha_atual' => 'required',
                'senha' => 'required|min:8|max:255|regex:/(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/|confirmed',
                'senha_confirmation' => 'required'
            ],

            [
                'senha_atual.required' => 'O campo senha atual é obrigatório.',
                'senha.required' => 'O campo nova senha é obrigatório.',
                'senha.min' => 'O campo nova senha deve ter no mínimo :min caracteres.',
                'senha.max' => 'O campo nova senha deve ter no máximo :max caracteres.',
                'senha.regex' => 'O campo nova senha deve conter pelo menos uma letra maiúscula, uma letra minúscula e um número.',
                'senha.confirmed' => 'A confirmação da nova senha não corresponde.',
                'senha_confirmation.required' => 'O campo confirmar nova senha é obrigatório.'
            ]
        );

        $dados = Auth::user();
        $senha_atual = $request->input('senha_atual');
        $nova_senha = $request->input('senha');

        if (!password_verify($senha_atual, $dados->password)) {
            return redirect()->back()->withErrors(['senha_atual' => 'A senha atual está incorreta!']);
        }

        $dados->password = Hash::make($nova_senha);

        if (!$dados->save()) {
            return redirect()->back()->withErrors(['falha', 'Falha ao redefinir a senha! Tente novamente.']);
        }

        return redirect()->route('atualizar.conta')->with('sucesso_redefinir', 'Senha redefinida com sucesso!');
    }

    public function confirmarDeletar(): RedirectResponse {

        session()->flash('confirmar', [
            'acao' => 'deletar'
        ]);

        return redirect()->back();
    }

    public function deletarConta(): RedirectResponse {

        $cliente = Auth::user();

        if (!$cliente->delete()) {
            session()->flash('resultado', [
                'titulo' => 'ERRO',
                'menssagem' => 'Falha ao tentar deletar a conta! Tente novamente.',
                'icone' => 'error'
            ]);

            return redirect()->back();
        }

        Compra::where('user_id', Auth::user()->id)
                ->update([
                    'status' => CompraStatus::CANCELADO,
                    'data_efetuacao' => Carbon::now()
                ]);

        return redirect()->route('logout');
    }

    public function compras(): View {

        $id = Auth::user()->id;
        $cliente = User::find($id);
        $compras = $cliente->compras()->where('status', CompraStatus::PENDENTE)
                                    ->get()
                                    ->map(function ($compra) {
                                        $compra->id_crypt = Crypt::encrypt($compra->id);
                                        $compra->valor_formatado = number_format(
                                            $compra->valor,
                                            2,
                                            ',',
                                            '.'
                                        );

                                        return $compra;
                                    });
        $concluidos = $cliente->compras()->where('status', '!=', CompraStatus::PENDENTE)
                                    ->get()
                                    ->map(function ($concluido) {
                                        $concluido->id_crypt = Crypt::encrypt($concluido->id);
                                        $concluido->valor_formatado = number_format(
                                            $concluido->valor,
                                            2,
                                            ',',
                                            '.'
                                        );

                                        return $concluido;
                                    });

        return view('compras')
            ->with('pagina', 'Minhas Compras')
            ->with('compras', $compras)
            ->with('concluidos', $concluidos);
    }

    public function apagar($id): RedirectResponse {

        $id = Crypt::decrypt($id);
        $compra = Compra::find($id);

        $compra->delete();

        return redirect()->back();
    }    
}