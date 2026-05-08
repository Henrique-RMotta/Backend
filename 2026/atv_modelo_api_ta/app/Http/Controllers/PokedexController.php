<?php

namespace App\Http\Controllers;

use App\Models\Pokedex;
use Illuminate\Http\Request;

class PokedexController extends Controller
{

public function create()
    {
        return view('pokemon.create'); 
    }
   public function store(Request $request)
{
    $dados = $request->validate([
        'POKE_name'        => 'required|string',
        'POKE_height'      => 'required|numeric',
        'POKE_weight'      => 'required|numeric',
        'POKE_stats'       => 'required|array',
        'POKE_generation'  => 'required|string|max:50',
        'POKE_sprite'      => 'nullable|image|max:2048',
        'POKE_shiny'       => 'nullable|image|max:2048',
        'POKE_abilities'   => 'required|array',
        'POKE_abilities.*' => 'string',
        'POKE_elements'    => 'required|array|max:2',
        'POKE_audio'       => 'nullable|file|max:5120',
        'POKE_xp'          => 'required|integer|min:0',
    ]);

    // Abilities → string
    $dados['POKE_abilities'] = implode(', ', $request->POKE_abilities);

    // Elements → string
    $dados['POKE_elements'] = implode(', ', $request->POKE_elements);

    // POKE_stats → JSON  ← FIX PROBLEMA 4
    // O cast 'array' no Model faz o encode/decode automaticamente,
    // mas precisamos garantir que chegue como array limpo:
    $dados['POKE_stats'] = $request->input('POKE_stats'); // já é array, o cast encode

    // Sprite normal
    if ($request->hasFile('POKE_sprite')) {
        $dados['POKE_sprite'] = $request->file('POKE_sprite')->store('pokemons', 'public');
    }

    // Sprite shiny
    if ($request->hasFile('POKE_shiny')) {
        $dados['POKE_shiny'] = $request->file('POKE_shiny')->store('pokemons', 'public');
    }

    // Áudio
    if ($request->hasFile('POKE_audio')) {
        $dados['POKE_audio'] = $request->file('POKE_audio')->store('cries', 'public');
    }

    Pokedex::create($dados);

    return redirect()->route('pokemon.index')->with('success', 'Pokémon adicionado à Pokédex!');
}
}

