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
        // 1. Pega o que o usuário digitou (ou carrega o #1 por padrão)
        $busca = $request->input('pokemon', 1); 

        // 2. TENTA BUSCAR NO BANCO DE DADOS PRIMEIRO
            $query = Pokedex::query();

            if (is_numeric($busca)) {
                // Se digitou um número (ex: 1, 15, 10001), busca no ID
                $query->where('id', $busca);
            } else {
                // Se digitou um texto (ex: "Pikachu"), busca no POKE_name
                $query->where('POKE_name', $busca);
            }

            $localPokemon = $query->first();

        if ($localPokemon) {
            // 3. SE ACHOU NO BANCO: Fantasiamos os dados para a View não quebrar
            $pokemon = $this->adaptarPokemonLocal($localPokemon);
            $evolucoes = []; // Pokémon customizados não terão evolução por enquanto
        } else {
            // 4. SE NÃO ACHOU NO BANCO: Busca na PokéAPI
            $response = Http::get("https://pokeapi.co/api/v2/pokemon/{$busca}");
            
            if ($response->failed()) {
                return back()->with('Erro', 'Pokémon não encontrado!');
            }
            
            $pokemon = $response->json();
            
            // 5. Busca as Evoluções da API
            $evolucoes = $this->buscarEvolucoesApi($pokemon['species']['url']);
        }

        return view('pokemon.index', compact('pokemon', 'evolucoes'));
    }

    // --- FUNÇÕES AUXILIARES --- //

    private function adaptarPokemonLocal($local)
    {
        // 1. Prepara os Elementos: Verifica se já é array. Se não for, usa o explode. Se estiver vazio, usa ['normal']
        $rawElements = $local->POKE_elements ?: ['normal'];
        $elementosArray = is_array($rawElements) ? $rawElements : explode(',', $rawElements);

        $types = array_map(function($tipo) {
            return ['type' => ['name' => strtolower(trim($tipo))]];
        }, $elementosArray);


        // 2. Prepara as Habilidades: Verifica se já é array. Se não for, usa o explode. Se estiver vazio, usa ['desconhecida']
        $rawAbilities = $local->POKE_abilities ?: ['desconhecida'];
        $habilidadesArray = is_array($rawAbilities) ? $rawAbilities : explode(',', $rawAbilities);

        $abilities = array_map(function($hab) {
            return ['ability' => ['name' => trim($hab)], 'is_hidden' => false];
        }, $habilidadesArray);

        // Mapeando os status para o formato da API
        $statsFormatados = [];
        $nomesStats = ['hp', 'attack', 'defense', 'special-attack', 'special-defense', 'speed'];
        
        // Garante que POKE_stats também seja um array (caso seja salvo no banco e não castado)
        $estatisticas = $local->POKE_stats ?: [];
        $estatisticasArray = is_array($estatisticas) ? $estatisticas : explode(',', $estatisticas);
        
        foreach ($nomesStats as $index => $nomeStat) {
            $statsFormatados[] = [
                'base_stat' => $estatisticasArray[$index] ?? 50, // Pega o stat ou usa 50 como padrão
                'stat' => ['name' => $nomeStat]
            ];
        }

        return [
            'id' => $local->id + 10000, // Dá um ID alto pra não misturar com os oficiais
            'name' => $local->POKE_name,
            'height' => $local->POKE_height,
            'weight' => $local->POKE_weight,
            'base_experience' => $local->POKE_xp,
            'types' => $types,
            'abilities' => $abilities,
            'stats' => $statsFormatados,
            'sprites' => [
                'front_shiny' => asset('storage/' . $local->POKE_sprite),
                'other' => [
                    'official-artwork' => [
                        'front_default' => asset('storage/' . $local->POKE_sprite)
                    ]
                ]
            ],
            'cries' => [
                'latest' => $local->POKE_audio ? asset('storage/' . $local->POKE_audio) : null
            ]
        ];
    }

    private function buscarEvolucoesApi($speciesUrl)
    {
        $species = Http::get($speciesUrl)->json();
        $evoChainUrl = $species['evolution_chain']['url'];
        $evoData = Http::get($evoChainUrl)->json();

        $evolucoes = [];
        $atual = $evoData['chain'];

        // Percorre a árvore de evoluções
        do {
            $nome = $atual['species']['name'];
            // Pegamos a imagem diretamente usando o ID do pokemon (extraído da URL)
            $urlParts = explode('/', rtrim($atual['species']['url'], '/'));
            $id = end($urlParts);
            
            $evolucoes[] = [
                'name' => $nome,
                'image' => "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/{$id}.png"
            ];
            
            $atual = $atual['evolves_to'][0] ?? null;
        } while ($atual != null);

        return $evolucoes;
    }
}