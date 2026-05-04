<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="/favicon.png">
    <title>Pokédex — {{ ucfirst($pokemon['name']) }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --type-fire:     #FF6B35;
            --type-water:    #4A90D9;
            --type-grass:    #5DBB63;
            --type-electric: #F7C948;
            --type-ice:      #74C2C9;
            --type-fighting: #C94040;
            --type-poison:   #9B59B6;
            --type-ground:   #C9A84C;
            --type-flying:   #7986CB;
            --type-psychic:  #E91E8C;
            --type-bug:      #8BC34A;
            --type-rock:     #9E8D5A;
            --type-ghost:    #5C4F8A;
            --type-dragon:   #5038DC;
            --type-dark:     #4A3728;
            --type-steel:    #8499A4;
            --type-fairy:    #E8A7C8;
            --type-normal:   #9A9A7A;
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: 'Nunito', sans-serif;
            background: #0f0f1a;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            overflow-x: hidden;
        }

        .mono { font-family: 'Space Mono', monospace; }

        /* ── BG PARTICLES ── */
        .bg-orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.12;
            pointer-events: none;
            animation: drift 18s ease-in-out infinite alternate;
        }
        .bg-orb-1 { width: 500px; height: 500px; background: #e53935; top: -120px; left: -120px; animation-delay: 0s; }
        .bg-orb-2 { width: 400px; height: 400px; background: #1565c0; bottom: -100px; right: -100px; animation-delay: -6s; }
        .bg-orb-3 { width: 300px; height: 300px; background: #6a1de8; top: 40%; left: 50%; animation-delay: -12s; }

        @keyframes drift {
            0%   { transform: translate(0, 0) scale(1); }
            100% { transform: translate(40px, 30px) scale(1.1); }
        }

        /* ── CREATE POKEMON TAB (ABINHA LATERAL) ── */
        .create-tab {
            position: fixed;
            top: 50%;
            right: 0;
            transform: translateY(-50%) translateX(calc(100% - 56px)); /* Esconde a aba, deixando 56px visíveis */
            background: rgba(229, 57, 53, 0.85); /* Fundo vermelho puxado pro vidro */
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.15);
            border-right: none;
            border-radius: 20px 0 0 20px;
            padding: 0.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            color: #fff;
            text-decoration: none;
            box-shadow: -4px 8px 24px rgba(0,0,0,0.4);
            z-index: 100;
            transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1), background 0.3s ease;
        }

        .create-tab:hover {
            transform: translateY(-50%) translateX(0); /* Revela toda a aba no hover */
            background: rgba(239, 83, 80, 1);
        }

        .create-tab-icon {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border: 1px solid rgba(255,255,255,0.3);
            transition: transform 0.3s ease;
        }

        .create-tab:hover .create-tab-icon {
            transform: rotate(90deg);
        }

        .create-tab-text {
            font-weight: 800;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            white-space: nowrap;
            padding-right: 1.25rem;
        }

        /* ── CARD ── */
        .card {
            position: relative;
            width: 100%;
            max-width: 420px;
            background: rgba(18, 18, 30, 0.85);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 28px;
            backdrop-filter: blur(24px);
            box-shadow:
                0 0 0 1px rgba(255,255,255,0.04),
                0 24px 64px rgba(0,0,0,0.7),
                inset 0 1px 0 rgba(255,255,255,0.08);
            overflow: hidden;
            animation: slideUp .5s cubic-bezier(0.16,1,0.3,1) both;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(32px) scale(0.97); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        /* ── HERO SECTION ── */
        .hero {
            position: relative;
            padding: 2rem 2rem 1rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            overflow: hidden;
        }

        .hero-bg {
            position: absolute;
            inset: 0;
            opacity: 0.07;
            background-image: radial-gradient(circle, currentColor 1px, transparent 1px);
            background-size: 24px 24px;
        }

        .pokeball-deco {
            position: absolute;
            width: 280px;
            height: 280px;
            border-radius: 50%;
            border: 42px solid rgba(255,255,255,0.04);
            top: -100px;
            right: -80px;
            pointer-events: none;
        }
        .pokeball-deco::after {
            content: '';
            position: absolute;
            inset: -4px;
            border-radius: 50%;
            border: 2px solid rgba(255,255,255,0.06);
        }

        .badge-id {
            align-self: flex-end;
            font-family: 'Space Mono', monospace;
            font-size: 0.72rem;
            color: rgba(255,255,255,0.3);
            letter-spacing: 0.08em;
            margin-bottom: 0.25rem;
        }

        .poke-img-wrap {
            position: relative;
            width: 188px;
            height: 188px;
            cursor: pointer;
        }

        .poke-img-wrap::before {
            content: '';
            position: absolute;
            inset: 10%;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 70%);
            filter: blur(20px);
            transition: opacity .3s;
        }

        .poke-img-wrap:hover::before { opacity: 1.8; }

        .poke-img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            transition: transform .4s cubic-bezier(0.34,1.56,0.64,1), opacity .25s;
            filter: drop-shadow(0 8px 32px rgba(0,0,0,0.5));
        }

        .poke-img-wrap:hover .poke-img { transform: scale(1.08) translateY(-4px); }

        .shiny-badge {
            position: absolute;
            top: 4px;
            right: 4px;
            width: 28px;
            height: 28px;
            background: linear-gradient(135deg, #ffd700, #ffb300);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            opacity: 0;
            transform: scale(0);
            transition: all .3s cubic-bezier(0.34,1.56,0.64,1);
            box-shadow: 0 0 12px rgba(255,215,0,0.6);
        }

        .shiny-badge.visible { opacity: 1; transform: scale(1); }

        /* ── NAME + TYPES ── */
        .poke-name {
            font-size: 2rem;
            font-weight: 900;
            letter-spacing: -0.02em;
            color: #fff;
            text-transform: capitalize;
            margin-top: 0.75rem;
            line-height: 1;
        }

        .gen-tag {
            font-family: 'Space Mono', monospace;
            font-size: 0.6rem;
            color: rgba(255,255,255,0.35);
            letter-spacing: 0.15em;
            text-transform: uppercase;
            margin-top: 0.2rem;
        }

        .type-chips {
            display: flex;
            gap: 0.5rem;
            margin-top: 0.75rem;
        }

        .chip {
            padding: 0.3rem 1rem;
            border-radius: 999px;
            font-size: 0.72rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #fff;
            border: 1px solid rgba(255,255,255,0.18);
        }

        /* ── SEARCH ── */
        .search-row {
            display: flex;
            gap: 0.5rem;
            padding: 1rem 1.5rem 0;
        }

        .search-input {
            flex: 1;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            padding: 0.6rem 1rem;
            color: #fff;
            font-family: 'Nunito', sans-serif;
            font-size: 0.875rem;
            font-weight: 700;
            outline: none;
            transition: border-color .2s, background .2s;
        }

        .search-input::placeholder { color: rgba(255,255,255,0.25); }
        .search-input:focus {
            border-color: rgba(255,255,255,0.3);
            background: rgba(255,255,255,0.08);
        }

        .search-btn {
            width: 42px;
            height: 42px;
            background: #e53935;
            border: none;
            border-radius: 12px;
            color: #fff;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background .2s, transform .1s;
            flex-shrink: 0;
        }

        .search-btn:hover  { background: #ef5350; }
        .search-btn:active { transform: scale(0.93); }

        /* ── INFO GRID ── */
        .info-section {
            padding: 1.25rem 1.5rem 0;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.5rem;
        }

        .info-cell {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 14px;
            padding: 0.75rem 0.5rem;
            text-align: center;
        }

        .info-label {
            font-size: 0.6rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: rgba(255,255,255,0.3);
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .info-value {
            font-size: 1.05rem;
            font-weight: 900;
            color: #fff;
        }

        /* ── ABILITIES ── */
        .abilities-wrap {
            margin-top: 0.5rem;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 14px;
            padding: 0.75rem 1rem;
        }

        .section-label {
            font-size: 0.6rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: rgba(255,255,255,0.3);
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .ability-chips { display: flex; flex-wrap: wrap; gap: 0.4rem; }

        .ability-chip {
            padding: 0.25rem 0.7rem;
            border-radius: 8px;
            font-size: 0.72rem;
            font-weight: 800;
            text-transform: capitalize;
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.1);
            color: rgba(255,255,255,0.75);
        }

        .ability-chip.hidden-ability {
            background: rgba(251,191,36,0.12);
            border-color: rgba(251,191,36,0.3);
            color: #fbbf24;
        }

        /* ── STATS ── */
        .stats-section {
            padding: 0 1.5rem 1.5rem;
            margin-top: 0.5rem;
        }

        .stat-row {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.6rem;
        }

        .stat-name {
            width: 52px;
            font-size: 0.62rem;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: rgba(255,255,255,0.35);
            font-weight: 700;
            flex-shrink: 0;
            font-family: 'Space Mono', monospace;
        }

        .stat-track {
            flex: 1;
            height: 5px;
            background: rgba(255,255,255,0.07);
            border-radius: 999px;
            overflow: visible;
            position: relative;
        }

        .stat-fill {
            height: 100%;
            border-radius: 999px;
            position: relative;
            animation: fillBar 1s cubic-bezier(0.16,1,0.3,1) both;
            animation-delay: .2s;
        }

        @keyframes fillBar {
            from { width: 0 !important; }
        }

        .stat-fill::after {
            content: '';
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: inherit;
            box-shadow: 0 0 8px currentColor;
        }

        .stat-num {
            width: 28px;
            text-align: right;
            font-family: 'Space Mono', monospace;
            font-size: 0.7rem;
            color: rgba(255,255,255,0.5);
            flex-shrink: 0;
        }

        /* ── BOTTOM NAV ── */
        .bottom-nav {
            display: grid;
            grid-template-columns: 1fr auto auto 1fr;
            gap: 0.5rem;
            padding: 0 1.5rem 1.5rem;
        }

        .nav-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 46px;
            border-radius: 14px;
            border: 1px solid rgba(255,255,255,0.1);
            background: rgba(255,255,255,0.05);
            color: rgba(255,255,255,0.6);
            cursor: pointer;
            transition: background .2s, color .2s, transform .1s, border-color .2s;
            text-decoration: none;
        }

        .nav-btn:hover  { background: rgba(255,255,255,0.1); color: #fff; border-color: rgba(255,255,255,0.2); }
        .nav-btn:active { transform: scale(0.93); }

        .nav-btn.accent-blue {
            background: rgba(37,99,235,0.2);
            border-color: rgba(37,99,235,0.4);
            color: #60a5fa;
        }
        .nav-btn.accent-blue:hover { background: rgba(37,99,235,0.35); color: #93c5fd; }

        .nav-btn.accent-yellow {
            background: rgba(245,158,11,0.15);
            border-color: rgba(245,158,11,0.35);
            color: #fbbf24;
        }
        .nav-btn.accent-yellow:hover { background: rgba(245,158,11,0.28); color: #fde68a; }

        /* ── DIVIDER ── */
        .divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.07), transparent);
            margin: 0 1.5rem 1.25rem;
        }

        /* ── ERROR TOAST ── */
        .toast {
            margin: 0 1.5rem 1rem;
            background: rgba(239,68,68,0.12);
            border: 1px solid rgba(239,68,68,0.3);
            border-radius: 12px;
            padding: 0.6rem 1rem;
            font-size: 0.78rem;
            font-weight: 700;
            color: #fca5a5;
            text-align: center;
        }

        /* ── STAT COLORS ── */
        .hp-fill      { background: linear-gradient(90deg, #22c55e, #86efac); color: #22c55e; }
        .atk-fill     { background: linear-gradient(90deg, #f97316, #fdba74); color: #f97316; }
        .def-fill     { background: linear-gradient(90deg, #3b82f6, #93c5fd); color: #3b82f6; }
        .satk-fill    { background: linear-gradient(90deg, #a855f7, #d8b4fe); color: #a855f7; }
        .sdef-fill    { background: linear-gradient(90deg, #ec4899, #f9a8d4); color: #ec4899; }
        .spd-fill     { background: linear-gradient(90deg, #eab308, #fde047); color: #eab308; }
        .gen-fill     { background: linear-gradient(90deg, #06b6d4, #67e8f9); color: #06b6d4; }

        /* ── EVOLUTIONS ── */
        .evo-section { padding: 0 1.5rem 1.5rem; }
        .evo-chain {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 14px;
            padding: 1rem;
            overflow-x: auto;
        }
        .evo-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            transition: transform 0.2s;
        }
        .evo-item:hover { transform: translateY(-3px); }
        .evo-img {
            width: 60px;
            height: 60px;
            object-fit: contain;
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.4));
        }
        .evo-name {
            font-size: 0.65rem;
            font-weight: 800;
            color: #fff;
            text-transform: capitalize;
        }
        .evo-arrow { color: rgba(255,255,255,0.2); font-size: 1.2rem; }
    </style>
</head>
<body>

    <div class="bg-orb bg-orb-1"></div>
    <div class="bg-orb bg-orb-2"></div>
    <div class="bg-orb bg-orb-3"></div>

    <a href="/pokedex/create" class="create-tab" title="Criar novo Pokémon">
        <div class="create-tab-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
        </div>
        <span class="create-tab-text">Criar Pokémon</span>
    </a>

    @php
        $id = $pokemon['id'];
        $gen = 'Desconhecida';
        if ($id <= 151)      $gen = 'Geração I';
        elseif ($id <= 251)  $gen = 'Geração II';
        elseif ($id <= 386)  $gen = 'Geração III';
        elseif ($id <= 493)  $gen = 'Geração IV';
        elseif ($id <= 649)  $gen = 'Geração V';
        elseif ($id <= 721)  $gen = 'Geração VI';
        elseif ($id <= 809)  $gen = 'Geração VII';
        elseif ($id <= 905)  $gen = 'Geração VIII';
        elseif ($id <= 1025) $gen = 'Geração IX';

        $statClasses = [
            'hp'              => 'hp-fill',
            'attack'          => 'atk-fill',
            'defense'         => 'def-fill',
            'special-attack'  => 'satk-fill',
            'special-defense' => 'sdef-fill',
            'speed'           => 'spd-fill',
        ];
        $statLabels = [
            'hp'              => 'HP',
            'attack'          => 'ATK',
            'defense'         => 'DEF',
            'special-attack'  => 'S.ATK',
            'special-defense' => 'S.DEF',
            'speed'           => 'SPD',
        ];

        $firstType = $pokemon['types'][0]['type']['name'] ?? 'normal';
    @endphp

    <div class="card">

        <div class="hero">
            <div class="hero-bg" style="color: var(--type-{{ $firstType }})"></div>
            <div class="pokeball-deco"></div>

            <span class="badge-id mono">#{{ str_pad($pokemon['id'], 4, '0', STR_PAD_LEFT) }}</span>

            <div class="poke-img-wrap" onclick="toggleShiny()">
                <div class="shiny-badge" id="shinyBadge">✨</div>
                <img id="poke-img"
                     src="{{ $pokemon['sprites']['other']['official-artwork']['front_default'] }}"
                     alt="{{ $pokemon['name'] }}"
                     class="poke-img">
            </div>

            <h1 class="poke-name">{{ $pokemon['name'] }}</h1>
            <span class="gen-tag">{{ $gen }}</span>

            <div class="type-chips">
                @foreach ($pokemon['types'] as $tipo)
                    <span class="chip" style="background-color: var(--type-{{ $tipo['type']['name'] }});">
                        {{ $tipo['type']['name'] }}
                    </span>
                @endforeach
            </div>
        </div>
        
        <form action="{{ route('pokemon.index') }}" method="GET" class="search-row">
            <input
                type="text"
                name="pokemon"
                placeholder="Nome ou número..."
                class="search-input"
            />
            <button type="submit" class="search-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </button>
        </form>
        <div class="info-section">
            <div class="info-grid">
                <div class="info-cell">
                    <div class="info-label">Altura</div>
                    <div class="info-value">{{ $pokemon['height'] / 10 }} m</div>
                </div>
                <div class="info-cell">
                    <div class="info-label">Peso</div>
                    <div class="info-value">{{ $pokemon['weight'] / 10 }} kg</div>
                </div>
                <div class="info-cell">
                    <div class="info-label">Exp.</div>
                    <div class="info-value">{{ $pokemon['base_experience'] ?? '—' }}</div>
                </div>
            </div>

            <div class="abilities-wrap" style="margin-top: 0.5rem;">
                <div class="section-label">Habilidades</div>
                <div class="ability-chips">
                    @foreach($pokemon['abilities'] as $habilidade)
                        <span class="ability-chip {{ $habilidade['is_hidden'] ? 'hidden-ability' : '' }}">
                            {{ str_replace('-', ' ', $habilidade['ability']['name']) }}
                            @if($habilidade['is_hidden'])
                                <span style="font-size:.6rem; opacity:.7; margin-left:2px;">●oculta</span>
                            @endif
                        </span>
                    @endforeach
                </div>
            </div>
        </div>


        <div class="stats-section" style="margin-top: 1.25rem;">
            <div class="section-label" style="padding: 0 0 0.5rem;">Base Stats</div>
            @php $totalStats = 0; @endphp
            @foreach($pokemon['stats'] as $stat)
                @php
                    $totalStats += $stat['base_stat'];
                    $key = $stat['stat']['name'];
                    $fillClass = $statClasses[$key] ?? 'gen-fill';
                    $label = $statLabels[$key] ?? strtoupper(substr($key, 0, 5));
                    $pct = min(($stat['base_stat'] / 255) * 100, 100);
                @endphp
                <div class="stat-row">
                    <span class="stat-name">{{ $label }}</span>
                    <div class="stat-track">
                        <div class="stat-fill {{ $fillClass }}" style="width: {{ $pct }}%"></div>
                    </div>
                    <span class="stat-num">{{ $stat['base_stat'] }}</span>
                </div>
            @endforeach
            <div class="stat-row" style="margin-top: 0.75rem; padding-top: 0.75rem; border-top: 1px solid rgba(255,255,255,0.06);">
                <span class="stat-name" style="color: rgba(255,255,255,0.5);">TOTAL</span>
                <div style="flex:1"></div>
                <span class="stat-num" style="color: #fff; font-size: 0.78rem;">{{ $totalStats }}</span>
            </div>
        </div>

        <div class="divider"></div>

        <div class="bottom-nav">
            <a href="{{ route('pokemon.index', ['pokemon' => $pokemon['id'] - 1]) }}" class="nav-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>

            <button onclick="playCry()" class="nav-btn accent-blue" title="Ouvir grito" style="width:46px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"/>
                </svg>
            </button>

            <button onclick="toggleShiny()" class="nav-btn accent-yellow" title="Versão shiny" style="width:46px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2l2.4 7.2h7.6l-6.1 4.5 2.3 7.3-6.2-4.6-6.2 4.6 2.3-7.3-6.1-4.5h7.6z"/>
                </svg>
            </button>

            <a href="{{ route('pokemon.index', ['pokemon' => $pokemon['id'] + 1]) }}" class="nav-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        @if(session('Erro'))
            <div class="toast">⚠️ {{ session('Erro') }}</div>
        @endif

    </div>

    @if(isset($pokemon['cries']['latest']))
        <audio id="poke-cry" src="{{ $pokemon['cries']['latest'] }}"></audio>
    @endif

    <script>
        let isShiny = false;
        const imgEl    = document.getElementById('poke-img');
        const badgeEl  = document.getElementById('shinyBadge');
        const normalSrc = "{{ $pokemon['sprites']['other']['official-artwork']['front_default'] }}";
        const shinySrc  = "{{ $pokemon['sprites']['other']['official-artwork']['front_shiny'] ?? $pokemon['sprites']['front_shiny'] ?? '' }}";

        function toggleShiny() {
            isShiny = !isShiny;
            imgEl.style.opacity = '0';
            imgEl.style.transform = 'scale(0.88)';
            setTimeout(() => {
                imgEl.src = isShiny ? shinySrc : normalSrc;
                imgEl.style.opacity = '1';
                imgEl.style.transform = 'scale(1)';
            }, 220);
            badgeEl.classList.toggle('visible', isShiny);
        }

        function playCry() {
            const audio = document.getElementById('poke-cry');
            if (audio) { audio.currentTime = 0; audio.volume = 0.5; audio.play(); }
        }

        // smooth image transition
        imgEl.style.transition = 'opacity .22s ease, transform .22s ease';
    </script>
</body>
</html>