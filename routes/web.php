<?php

use App\Http\Controllers\MainController;
use App\Http\Middleware\Checar;
use Illuminate\Support\Facades\Route;

Route::get("/", [MainController::class, "inicio"])->name("inicio");

Route::middleware(["auth", "verified"])->group(function() {
    Route::prefix("/")->group(function () {
        Route::get("home", [MainController::class, "home"])->name("home");
        Route::get("comprar", [MainController::class, "comprar"])->name("comprar");
    });
});

Route::fallback(function() {
    return redirect()->route("inicio");
});
