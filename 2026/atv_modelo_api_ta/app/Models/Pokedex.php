<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pokedex extends Model
{
    // Corrigido 'POKE_habilities' para 'POKE_abilities' e alterado para protected
    protected $fillable = [
        "POKE_name", 
        "POKE_elements", 
        "POKE_height", 
        "POKE_weight", 
        "POKE_stats", 
        "POKE_generation", 
        "POKE_sprite", 
        "POKE_shiny", 
        "POKE_abilities", 
        "POKE_audio", 
        "POKE_xp"
    ];

    // Adicionado os Casts (Obrigatório para colunas JSON no banco)
    protected $casts = [
        'POKE_elements'  => 'array',
        'POKE_stats'     => 'array',
        'POKE_abilities' => 'array',
    ];
}