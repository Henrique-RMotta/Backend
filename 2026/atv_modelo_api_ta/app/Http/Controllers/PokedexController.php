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
    // 1. Faz a validação (lembre-se de mudar de string para array como mostrado acima)
    $dados = $request->validate([
        'POKE_name' => 'required|string',
        'POKE_height'     => 'required|numeric',
        'POKE_weight'     => 'required|numeric',
        'POKE_stats'      => 'required|array',
        'POKE_generation' => 'required|string|max:50',
        'POKE_sprite'     => 'nullable|image|max:2048', 
        'POKE_shiny'      => 'nullable|boolean',
        'POKE_abilities' => 'required|array',
        'POKE_abilities.*' => 'string',
        'POKE_elements' => 'required|array|max:2', 
        'POKE_audio'      => 'nullable|file|max:5120', 
        'POKE_xp'         => 'required|integer|min:0',
    ]);

    // 2. Transforma os Arrays em texto (String) separado por vírgulas
    if ($request->has('POKE_abilities')) {
        // Transforma ['Blaze', 'Solar Power'] em "Blaze, Solar Power"
        $dados['POKE_abilities'] = implode(', ', $request->POKE_abilities);
    }

    if ($request->has('POKE_elements')) {
        // Transforma ['Fire', 'Flying'] em "Fire, Flying"
        $dados['POKE_elements'] = implode(', ', $request->POKE_elements);
    }

    // 3. Salva no banco de dados com as strings formatadas
    Pokedex::create($dados);

    // 4. Redireciona com sucesso
    return redirect()->route("pokemon.index")->with('success', 'Pokémon adicionado à Pokédex!');
}
}

