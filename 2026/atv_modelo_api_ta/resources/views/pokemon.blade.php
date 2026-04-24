<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokédex Ultra - {{ ucfirst($pokemon['name']) }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Rajdhani:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Rajdhani', sans-serif; }
        .pixel-font { font-family: 'Press Start 2P', cursive; }
        .pokedex-red { background-color: #dc0a2d; }
        .pokedex-dark-red { background-color: #8b0000; }
        .screen-glass { background: rgba(255, 255, 255, 0.15); backdrop-filter: blur(10px); }
        .stat-bar { transition: width 1s ease-in-out; }
        
        /* Cores dinâmicas para os tipos */
        .type-fire { background-color: #F08030; }
        .type-water { background-color: #6890F0; }
        .type-grass { background-color: #78C850; }
        .type-electric { background-color: #F8D030; }
        .type-ice { background-color: #98D8D8; }
        .type-fighting { background-color: #C03028; }
        .type-poison { background-color: #A040A0; }
        .type-ground { background-color: #E0C068; }
        .type-flying { background-color: #A890F0; }
        .type-psychic { background-color: #F85888; }
        .type-bug { background-color: #A8B820; }
        .type-rock { background-color: #B8A038; }
        .type-ghost { background-color: #705898; }
        .type-dragon { background-color: #7038F8; }
        .type-dark { background-color: #705848; }
        .type-steel { background-color: #B8B8D0; }
        .type-fairy { background-color: #EE99AC; }
        .type-normal { background-color: #A8A878; }
    </style>
</head>
<body class="bg-slate-900 flex items-center justify-center min-h-screen p-4">

    <div class="relative w-full max-w-md">
        
        <div class="absolute -top-6 left-6 flex items-center gap-3 z-10">
            <div class="w-12 h-12 bg-blue-400 border-4 border-white rounded-full shadow-[0_0_15px_rgba(96,165,250,0.8)] animate-pulse"></div>
            <div class="w-3 h-3 bg-red-600 rounded-full border border-black"></div>
            <div class="w-3 h-3 bg-yellow-400 rounded-full border border-black"></div>
            <div class="w-3 h-3 bg-green-500 rounded-full border border-black"></div>
        </div>

        <div class="pokedex-red p-1 rounded-3xl shadow-2xl border-b-8 border-r-8 border-black">
            <div class="p-6">
                
                <form action="{{ route('pokemon.index') }}" method="GET" class="flex gap-2 mb-6 mt-4">
                    <input 
                        type="text" 
                        name="pokemon" 
                        placeholder="Nome ou ID..."
                        class="w-full bg-green-200 border-2 border-green-800 rounded-lg px-4 py-2 text-green-900 font-bold placeholder-green-700 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                    />
                    <button class="bg-blue-600 hover:bg-blue-700 text-white p-2 rounded-lg transition-transform active:scale-95 shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>

                <div class="bg-gray-200 rounded-xl p-4 border-4 border-gray-400 shadow-inner relative overflow-hidden group">
                    <div class="absolute top-2 right-4 text-gray-400 font-bold">#{{ str_pad($pokemon['id'], 3, '0', STR_PAD_LEFT) }}</div>
                    
                    <img id="poke-img" 
                         src="{{ $pokemon['sprites']['other']['official-artwork']['front_default'] }}" 
                         alt="{{ $pokemon['name'] }}" 
                         class="w-48 h-48 mx-auto drop-shadow-2xl transition-all duration-500 group-hover:scale-110">
                    
                    <div class="flex justify-center gap-2 mt-2">
                        @foreach ($pokemon['types'] as $tipo)
                            <span class="type-{{ $tipo['type']['name'] }} px-4 py-1 text-white text-xs font-bold rounded-full uppercase shadow-md border border-black/20">
                                {{ $tipo['type']['name'] }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <div class="mt-6 bg-green-900/90 p-4 rounded-lg border-2 border-green-700 text-green-400">
                    <h1 class="text-2xl font-bold uppercase mb-2 tracking-widest text-center text-white">{{ $pokemon['name'] }}</h1>
                    
                    <div class="grid grid-cols-2 gap-4 mb-4 text-xs">
                        <div class="bg-black/30 p-2 rounded">
                            <span class="block text-green-600 uppercase">Altura</span>
                            <span class="text-lg font-bold text-white">{{ $pokemon['height'] / 10 }} m</span>
                        </div>
                        <div class="bg-black/30 p-2 rounded">
                            <span class="block text-green-600 uppercase">Peso</span>
                            <span class="text-lg font-bold text-white">{{ $pokemon['weight'] / 10 }} kg</span>
                        </div>
                    </div>

                    <div class="space-y-2">
                        @foreach($pokemon['stats'] as $stat)
                        <div class="flex items-center gap-2">
                            <span class="w-12 text-[10px] uppercase font-bold">{{ str_replace('special-', 'S.', $stat['stat']['name']) }}</span>
                            <div class="flex-1 bg-black/40 h-2 rounded-full overflow-hidden">
                                <div class="stat-bar bg-yellow-400 h-full rounded-full" style="width: {{ ($stat['base_stat'] / 255) * 100 }}%"></div>
                            </div>
                            <span class="w-8 text-right text-[10px] font-bold text-white">{{ $stat['base_stat'] }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4 mt-6">
                    <a href="{{ route('pokemon.index', ['pokemon' => $pokemon['id'] - 1]) }}" 
                       class="pokedex-dark-red hover:bg-red-800 p-3 rounded-xl border-b-4 border-black text-white flex justify-center transition-all active:border-b-0 active:translate-y-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>

                    <button onclick="toggleShiny()" 
                            title="Ver versão Shiny"
                            class="bg-yellow-500 hover:bg-yellow-400 p-3 rounded-full border-b-4 border-yellow-700 text-white flex justify-center transition-all active:border-b-0 active:translate-y-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l2.4 7.2h7.6l-6.1 4.5 2.3 7.3-6.2-4.6-6.2 4.6 2.3-7.3-6.1-4.5h7.6z"/>
                        </svg>
                    </button>

                    <a href="{{ route('pokemon.index', ['pokemon' => $pokemon['id'] + 1]) }}" 
                       class="pokedex-dark-red hover:bg-red-800 p-3 rounded-xl border-b-4 border-black text-white flex justify-center transition-all active:border-b-0 active:translate-y-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                @if(session('Erro'))
                    <div class="mt-4 bg-yellow-200 text-red-700 p-2 rounded text-center text-xs font-bold animate-bounce">
                        ⚠️ {{ session('Erro') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        let isShiny = false;
        const imgElement = document.getElementById('poke-img');
        const normalImg = "{{ $pokemon['sprites']['other']['official-artwork']['front_default'] }}";
        const shinyImg = "{{ $pokemon['sprites']['other']['official-artwork']['front_shiny'] ?? $pokemon['sprites']['front_shiny'] }}";

        function toggleShiny() {
            isShiny = !isShiny;
            imgElement.style.opacity = '0';
            
            setTimeout(() => {
                imgElement.src = isShiny ? shinyImg : normalImg;
                imgElement.style.opacity = '1';
            }, 200);
        }
    </script>
</body>
</html>