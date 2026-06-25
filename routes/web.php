<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Compras;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Produtos;
use App\Http\Middleware\Permissao;
use Illuminate\Support\Facades\Route;

Route::prefix("/")->group(function () {
    Route::get("", [MainController::class, "inicio"])->name("inicio");

    Route::middleware(["auth", "verified"])->group(function() {
        Route::controller(MainController::class)->group(function() {
            Route::get("home/{categoria}", "home")->name("home");

            Route::get("atualizar-conta", "atualizarConta")->name("atualizar.conta");
            Route::post("atualizar", "atualizar")->name("atualizar");

            Route::get("redefinir-senha", "redefinirSenha")->name("redefinir.senha");
            Route::post("redefinir", "redefinir")->name("redefinir");

            Route::get("confirmar-deletar", "confirmardeletar")->name("confirmar.deletar");
            Route::delete("deletar-conta", "deletarConta")->name("deletar.conta");

            Route::get("compras", "compras")->name("compras");
            
            Route::delete("apagar/{id}", "apagar")->name("apagar");
        });

        Route::controller(Compras::class)->group(function() {
            Route::get("escolher/{id}", "escolher")->name("escolher");

            Route::post("confirmar-comprar/{id}", "confirmarComprar")->name("confirmar.comprar");
            Route::post("comprar/{id}/{quantidade}", "comprar")->name("comprar");

            Route::get("qrcode/{id}", "qrcode")->name("qrcode");

            Route::get("confirmar-cancelar/{id}", "confirmarCancelar")->name("confirmar.cancelar");
            Route::delete("cancelar-compra/{id}", "cancelarCompra")->name("cancelar.compra");            
        });

        Route::controller(Produtos::class)->group(function() {
            Route::post("importar", "importar")->name("importar");
            Route::get("exportar", "exportar")->name("exportar");
        });

        Route::controller(Admin::class)->group(function() {
            Route::middleware([Permissao::class])->group(function() {
                Route::get("admin", "admin")->name("admin");

                Route::get("confirmar-aprovar/{id}", "confirmarAprovar")->name("confirmar.aprovar");
                Route::post("aprovar/{id}", "aprovar")->name("aprovar");

                Route::post("novo-produto", "novoProduto")->name("novo.produto");

                Route::get("confirmar-resetar", "confirmarResetar")->name("confirmar.resetar");
                Route::delete("resetar", "resetar")->name("resetar");

                Route::post("pesquisar", "pesquisar")->name("pesquisar");
            });
        });
    });

    Route::fallback(function() {
        return redirect()->route("inicio");
    });
});