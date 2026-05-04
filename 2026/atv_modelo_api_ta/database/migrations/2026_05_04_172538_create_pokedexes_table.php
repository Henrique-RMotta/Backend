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
        Schema::create('pokedexes', function (Blueprint $table) {
            $table->id();
            $table->string('POKE_name', 100)->unique();
            $table->json('POKE_elements'); 
            $table->float('POKE_height');
            $table->float('POKE_weight');
            $table->json('POKE_stats');
            $table->string('POKE_generation');
            $table->string('POKE_sprite')->nullable();
            $table->boolean('POKE_shiny')->default(false);
            $table->json('POKE_abilities');
            $table->string('POKE_audio')->nullable();
            $table->integer('POKE_xp');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pokedexes');
    }
};
