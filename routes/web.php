<?php

use App\Http\Controllers\Compras;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get("/", [MainController::class, "inicio"])->name("inicio");

Route::middleware(["auth", "verified"])->group(function() {
    Route::prefix("/")->group(function () {
        Route::controller(MainController::class)->group(function() {
            Route::get("home", "home")->name("home");
            Route::get("editar", "editar")->name("editar");
            Route::post("atualizar", "atualizar")->name("atualizar");
            Route::post("pesquisar/{categoria}", "pesquisar")->name("pesquisar");
        });
        Route::controller(Compras::class)->group(function() {
            Route::get("escolher/{id}", "escolher")->name("escolher");
            Route::post("comprar", "comprar")->name("comprar");
        });        
    });
});

Route::fallback(function() {
    return redirect()->route("inicio");
});
