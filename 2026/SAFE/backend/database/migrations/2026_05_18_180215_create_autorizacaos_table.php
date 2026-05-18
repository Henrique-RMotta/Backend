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
        Schema::create('autorizacaos', function (Blueprint $table) {
            $table->id();
            $table->string('AUT_alunoname');        
            $table->string('AUT_alunoclass');
            $table->enum('AUT_type', ['entrada', 'saida']); 
            $table->string('AUT_nameaqv');
            $table->text('AUT_signature_image');
            $table->string('AUT_teacher_email')->nullable();
            $table->json('AUT_fouls')->nullable();  
            $table->dateTime('AUT_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('autorizacaos');
    }
};
