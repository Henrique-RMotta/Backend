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
        Schema::create("fornecedor", function (Blueprint $table) {
        $table->id();
        $table->string("FOR_nome");
        $table->string("FOR_CPF");
        $table->string("FOR_telefone");
        $table->string("FOR_endereco");
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fornecedor');
    }
};
