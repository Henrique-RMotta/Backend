<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pokedex;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PokemonController extends Controller
{
    public function index(Request $request)
    {
        $busca = $request->input('pokemon', 1);

        // ── FIX BUG IDs: só busca no banco se for texto (nome)
        // ou se for número >= 10001 (IDs reservados para pokémons custom).
        // Números 1–9999 vão DIRETO para a PokéAPI.
        $localPokemon = null;

        if (is_numeric($busca)) {
            if ((int)$busca >= 10001) {
                // ID no range custom → busca no banco pelo id real (sem o +10000)
                $localPokemon = Pokedex::where('id', (int)$busca - 10000)->first();
                // fallback: tenta também pelo id direto (para registros antigos)
                if (!$localPokemon) {
                    $localPokemon = Pokedex::where('id', (int)$busca)->first();
                }
            }
            // números 1–9999 → não toca no banco, cai direto na API abaixo
        } else {
            // busca por nome → verifica banco primeiro, depois API
            $localPokemon = Pokedex::whereRaw('LOWER(POKE_name) = ?', [strtolower($busca)])->first();
        }

        if ($localPokemon) {
            $pokemon   = $this->adaptarPokemonLocal($localPokemon);
            $evolucoes = [];
        } else {
            $response = Http::get("https://pokeapi.co/api/v2/pokemon/{$busca}");
            if ($response->failed()) {
                return back()->with('Erro', 'Pokémon não encontrado!');
            }
            $pokemon   = $response->json();
            $evolucoes = $this->buscarEvolucoesApi($pokemon['species']['url']);
        }

        return view('pokemon.index', compact('pokemon', 'evolucoes'));
    }

    private function adaptarPokemonLocal($local)
    {
        // ── Tipos ──
        $rawElements    = $local->POKE_elements ?: 'normal';
        $elementosArray = is_array($rawElements)
            ? $rawElements
            : array_map('trim', explode(',', $rawElements));

        $types = array_map(fn($t) => ['type' => ['name' => strtolower($t)]], $elementosArray);

        // ── Habilidades ──
        $rawAbilities    = $local->POKE_abilities ?: 'desconhecida';
        $habilidadesArray = is_array($rawAbilities)
            ? $rawAbilities
            : array_map('trim', explode(',', $rawAbilities));

        $abilities = array_map(fn($h) => [
            'ability'   => ['name' => $h],
            'is_hidden' => false,
        ], $habilidadesArray);

        // ── Stats ── FIX: POKE_stats é JSON {"hp":50,"attack":80,...}
        // O cast 'array' no Model já decodifica. Usamos as chaves nomeadas.
        $estatisticas = is_array($local->POKE_stats) ? $local->POKE_stats : [];

        $nomesStats = ['hp', 'attack', 'defense', 'special-attack', 'special-defense', 'speed'];
        // chaves no banco usam underscore (ex: special_attack) — mapeamos os dois formatos
        $aliasMap = [
            'special-attack'  => ['special-attack',  'special_attack'],
            'special-defense' => ['special-defense', 'special_defense'],
        ];

        $statsFormatados = [];
        foreach ($nomesStats as $nomeStat) {
            $val = 50; // padrão
            $keys = $aliasMap[$nomeStat] ?? [$nomeStat];
            foreach ($keys as $k) {
                if (isset($estatisticas[$k])) { $val = (int)$estatisticas[$k]; break; }
            }
            $statsFormatados[] = ['base_stat' => $val, 'stat' => ['name' => $nomeStat]];
        }

        // ── Sprites ── FIX: mantém POKE_sprite e POKE_shiny separados
        // O blade verifica isset($pokemon['POKE_sprite']), então devolvemos as chaves originais.
        $spriteUrl = $local->POKE_sprite
            ? asset('storage/' . $local->POKE_sprite)
            : null;

        $shinyUrl = $local->POKE_shiny
            ? asset('storage/' . $local->POKE_shiny)
            : null;

        return [
            // ─ identificação ─
            'id'              => $local->id,      // ID real do banco
            'POKE_id'         => $local->id,
            'name'            => $local->POKE_name,
            'POKE_name'       => $local->POKE_name,
            'POKE_generation' => $local->POKE_generation,

            // ─ físico ─
            'POKE_height'     => $local->POKE_height,
            'POKE_weight'     => $local->POKE_weight,
            'POKE_xp'         => $local->POKE_xp,

            // ─ batalha ─
            'types'           => $types,
            'abilities'       => $abilities,
            'stats'           => $estatisticas, // array ['hp'=>50,...] — o blade já sabe lidar

            // ─ mídia ─ FIX: chaves que o blade realmente lê
            'POKE_sprite'     => $local->POKE_sprite,   // caminho relativo (blade faz asset())
            'POKE_shiny'      => $local->POKE_shiny,    // caminho relativo (blade faz asset())
            'POKE_audio'      => $local->POKE_audio,

            // ─ compatibilidade com o formato API (fallback) ─
            'sprites' => [
                'other' => [
                    'official-artwork' => [
                        'front_default' => $spriteUrl,
                        'front_shiny'   => $shinyUrl,
                    ]
                ]
            ],
            'cries' => ['latest' => null], // áudio tratado via POKE_audio acima
        ];
    }

    private function buscarEvolucoesApi($speciesUrl)
    {
        $species     = Http::get($speciesUrl)->json();
        $evoData     = Http::get($species['evolution_chain']['url'])->json();
        $evolucoes   = [];
        $atual       = $evoData['chain'];

        do {
            $urlParts    = explode('/', rtrim($atual['species']['url'], '/'));
            $id          = end($urlParts);
            $evolucoes[] = [
                'name'  => $atual['species']['name'],
                'image' => "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/{$id}.png",
            ];
            $atual = $atual['evolves_to'][0] ?? null;
        } while ($atual !== null);

        return $evolucoes;
    }
}