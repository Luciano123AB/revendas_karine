<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Compras;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Produtos;
use App\Http\Controllers\Registros;
use App\Http\Middleware\Permissao;
use Illuminate\Support\Facades\Route;

Route::get("/", [MainController::class, "inicio"])->name("inicio");

Route::middleware(["auth", "verified"])->group(function() {
    Route::prefix("/")->group(function () {
        Route::controller(MainController::class)->group(function() {
            Route::get("home/{categoria}", "home")->name("home");
            Route::get("editar", "editar")->name("editar");
            Route::post("atualizar", "atualizar")->name("atualizar");            
            Route::get("apagar/{id}", "apagar")->name("apagar");            
        });
        Route::controller(Compras::class)->group(function() {
            Route::get("escolher/{id}", "escolher")->name("escolher");
            Route::post("confirmar_comprar/{id}/{estoque}", "confirmarComprar")->name("confirmar_comprar");
            Route::get("comprar/{id}/{quantidade}", "comprar")->name("comprar");
            Route::get("qrcode/{id}", "qrcode")->name("qrcode");
            Route::get("confirmar_cancelar/{id}", "confirmarCancelar")->name("confirmar_cancelar");
            Route::get("cancelar_compra/{id}", "cancelarCompra")->name("cancelar_compra");            
        });
        Route::controller(Registros::class)->group(function() {
            Route::get("pedidos", "pedidos")->name("pedidos");
            Route::get("historico", "historico")->name("historico");
        });
        Route::controller(Produtos::class)->group(function() {
            Route::post("importar", "importar")->name("importar");
            Route::get("exportar", "exportar")->name("exportar");
        });
        Route::controller(Admin::class)->group(function() {
            Route::middleware([Permissao::class])->group(function() {
                Route::get("admin", "admin")->name("admin");
                Route::get("confirmar_aprovar/{id}", "confirmarAprovar")->name("confirmar_aprovar");
                Route::get("aprovar/{id}", "aprovar")->name("aprovar");
                Route::post("novo_produto", "novoProduto")->name("novo_produto");
                Route::get("confirmar_resetar", "confirmarResetar")->name("confirmar_resetar");
                Route::get("resetar", "resetar")->name("resetar");
                Route::post("pesquisar", "pesquisar")->name("pesquisar");
            });
        });
    });
});

Route::fallback(function() {
    return redirect()->route("inicio");
});