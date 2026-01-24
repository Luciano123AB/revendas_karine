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
        Schema::create("notas", function (Blueprint $table) {
            $table->id()->comment("1");
            $table->string("titulo")->comment("...");
            $table->text("texto")->comment("...");
            $table->foreignId("user_id")->constrained()->cascadeOnDelete()->comment("1");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("notas");
    }
};
