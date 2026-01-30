<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->string("produto");
            $table->integer("quantidade");
            $table->decimal("valor", 10, 2);
            $table->longText("pix")->nullable()->comment("...BR.GOV.BCB.PIX...");
            $table->string("status")->comment("Pendente|Concluído|Cancelado");
            $table->foreignId("user_id")->constrained()->cascadeOnDelete();
            $table->timestamp("data_compra");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("compras");
    }
};