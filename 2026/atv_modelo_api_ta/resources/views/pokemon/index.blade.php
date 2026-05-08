<!DOCTYPE html>
<html lang="pt-br" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="/favicon.png">
    <title>Pokédex — {{ ucfirst($pokemon['name']) }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --type-fire: #FF6B35;
            --type-water: #4A90D9;
            --type-grass: #5DBB63;
            --type-electric: #F7C948;
            --type-ice: #74C2C9;
            --type-fighting: #C94040;
            --type-poison: #9B59B6;
            --type-ground: #C9A84C;
            --type-flying: #7986CB;
            --type-psychic: #E91E8C;
            --type-bug: #8BC34A;
            --type-rock: #9E8D5A;
            --type-ghost: #5C4F8A;
            --type-dragon: #5038DC;
            --type-dark: #4A3728;
            --type-steel: #8499A4;
            --type-fairy: #E8A7C8;
            --type-normal: #9A9A7A;
        }

        /* ══ THEME TOKENS ══ */
        [data-theme="dark"] {
            --bg: #0f0f1a;
            --card-bg: rgba(18, 18, 30, 0.85);
            --card-border: rgba(255, 255, 255, 0.08);
            --card-inset: rgba(255, 255, 255, 0.08);
            --cell-bg: rgba(255, 255, 255, 0.04);
            --cell-border: rgba(255, 255, 255, 0.07);
            --text: #ffffff;
            --text-2: rgba(255, 255, 255, 0.35);
            --text-3: rgba(255, 255, 255, 0.25);
            --input-bg: rgba(255, 255, 255, 0.05);
            --input-border: rgba(255, 255, 255, 0.10);
            --input-focus: rgba(255, 255, 255, 0.30);
            --divider: rgba(255, 255, 255, 0.07);
            --nav-bg: rgba(255, 255, 255, 0.05);
            --nav-border: rgba(255, 255, 255, 0.10);
            --shadow: 0 24px 64px rgba(0, 0, 0, 0.7);
            --orb-op: 0.12;
            --hero-dot: rgba(255, 255, 255, 0.07);
        }

        [data-theme="light"] {
            --bg: #eeeef5;
            --card-bg: rgba(255, 255, 255, 0.90);
            --card-border: rgba(0, 0, 0, 0.07);
            --card-inset: rgba(255, 255, 255, 0.80);
            --cell-bg: rgba(0, 0, 0, 0.03);
            --cell-border: rgba(0, 0, 0, 0.06);
            --text: #111118;
            --text-2: rgba(0, 0, 0, 0.40);
            --text-3: rgba(0, 0, 0, 0.22);
            --input-bg: rgba(0, 0, 0, 0.04);
            --input-border: rgba(0, 0, 0, 0.10);
            --input-focus: rgba(0, 0, 0, 0.30);
            --divider: rgba(0, 0, 0, 0.06);
            --nav-bg: rgba(0, 0, 0, 0.04);
            --nav-border: rgba(0, 0, 0, 0.08);
            --shadow: 0 16px 48px rgba(0, 0, 0, 0.13);
            --orb-op: 0.05;
            --hero-dot: rgba(0, 0, 0, 0.04);
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background: var(--bg);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            overflow-x: hidden;
            transition: background 0.35s;
        }

        .mono {
            font-family: 'Space Mono', monospace;
        }

        /* ── THEME BUTTON ── */
        .theme-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            width: 42px;
            height: 42px;
            border-radius: 12px;
            border: 1px solid var(--nav-border);
            background: var(--card-bg);
            backdrop-filter: blur(12px);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            z-index: 300;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .theme-btn:hover {
            transform: scale(1.1);
        }

        /* ── BG ORBS ── */
        .bg-orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            opacity: var(--orb-op);
            pointer-events: none;
            animation: drift 18s ease-in-out infinite alternate;
        }

        .bg-orb-1 {
            width: 500px;
            height: 500px;
            background: #e53935;
            top: -120px;
            left: -120px;
        }

        .bg-orb-2 {
            width: 400px;
            height: 400px;
            background: #1565c0;
            bottom: -100px;
            right: -100px;
            animation-delay: -6s;
        }

        .bg-orb-3 {
            width: 300px;
            height: 300px;
            background: #6a1de8;
            top: 40%;
            left: 50%;
            animation-delay: -12s;
        }

        @keyframes drift {
            0% {
                transform: translate(0, 0) scale(1);
            }

            100% {
                transform: translate(40px, 30px) scale(1.1);
            }
        }

        /* ── CREATE TAB ── */
        .create-tab {
            position: fixed;
            top: 50%;
            right: 0;
            transform: translateY(-50%) translateX(calc(100% - 56px));
            background: rgba(229, 57, 53, 0.85);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-right: none;
            border-radius: 20px 0 0 20px;
            padding: 0.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            color: #fff;
            text-decoration: none;
            box-shadow: -4px 8px 24px rgba(0, 0, 0, 0.4);
            z-index: 100;
            transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1), background 0.3s;
        }

        .create-tab:hover {
            transform: translateY(-50%) translateX(0);
            background: rgba(239, 83, 80, 1);
        }

        .create-tab-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: transform 0.3s;
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
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 28px;
            backdrop-filter: blur(24px);
            box-shadow:
                0 0 0 1px rgba(255, 255, 255, 0.04),
                var(--shadow),
                inset 0 1px 0 var(--card-inset);
            overflow: hidden;
            animation: slideUp .5s cubic-bezier(0.16, 1, 0.3, 1) both;
            transition: background 0.35s, border-color 0.35s, box-shadow 0.35s;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(32px) scale(0.97);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* ── HERO ── */
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
            background-image: radial-gradient(circle, var(--hero-dot) 1px, transparent 1px);
            background-size: 24px 24px;
        }

        [data-theme="light"] .hero-bg {
            opacity: 0.5;
        }

        .pokeball-deco {
            position: absolute;
            width: 280px;
            height: 280px;
            border-radius: 50%;
            border: 42px solid rgba(255, 255, 255, 0.04);
            top: -100px;
            right: -80px;
            pointer-events: none;
        }

        .pokeball-deco::after {
            content: '';
            position: absolute;
            inset: -4px;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.06);
        }

        [data-theme="light"] .pokeball-deco {
            border-color: rgba(0, 0, 0, 0.04);
        }

        [data-theme="light"] .pokeball-deco::after {
            border-color: rgba(0, 0, 0, 0.03);
        }

        .badge-id {
            align-self: flex-end;
            font-family: 'Space Mono', monospace;
            font-size: 0.72rem;
            color: var(--text-2);
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
            background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, transparent 70%);
            filter: blur(20px);
            transition: opacity .3s;
        }

        .poke-img-wrap:hover::before {
            opacity: 1.8;
        }

        .poke-img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            transition: transform .4s cubic-bezier(0.34, 1.56, 0.64, 1), opacity .25s;
            filter: drop-shadow(0 8px 32px rgba(0, 0, 0, 0.5));
        }

        [data-theme="light"] .poke-img {
            filter: drop-shadow(0 8px 24px rgba(0, 0, 0, 0.2));
        }

        .poke-img-wrap:hover .poke-img {
            transform: scale(1.08) translateY(-4px);
        }

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
            transition: all .3s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow: 0 0 12px rgba(255, 215, 0, 0.6);
        }

        .shiny-badge.visible {
            opacity: 1;
            transform: scale(1);
        }

        .poke-name {
            font-size: 2rem;
            font-weight: 900;
            letter-spacing: -0.02em;
            color: var(--text);
            text-transform: capitalize;
            margin-top: 0.75rem;
            line-height: 1;
        }

        .gen-tag {
            font-family: 'Space Mono', monospace;
            font-size: 0.6rem;
            color: var(--text-2);
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
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        /* ── SEARCH ── */
        .search-row {
            display: flex;
            gap: 0.5rem;
            padding: 1rem 1.5rem 0;
        }

        .search-input {
            flex: 1;
            background: var(--input-bg);
            border: 1px solid var(--input-border);
            border-radius: 12px;
            padding: 0.6rem 1rem;
            color: var(--text);
            font-family: 'Nunito', sans-serif;
            font-size: 0.875rem;
            font-weight: 700;
            outline: none;
            transition: border-color .2s, background .2s;
        }

        .search-input::placeholder {
            color: var(--text-3);
        }

        .search-input:focus {
            border-color: var(--input-focus);
            background: var(--input-bg);
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

        .search-btn:hover {
            background: #ef5350;
        }

        .search-btn:active {
            transform: scale(0.93);
        }

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
            background: var(--cell-bg);
            border: 1px solid var(--cell-border);
            border-radius: 14px;
            padding: 0.75rem 0.5rem;
            text-align: center;
            transition: background 0.35s, border-color 0.35s;
        }

        .info-label {
            font-size: 0.6rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--text-2);
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .info-value {
            font-size: 1.05rem;
            font-weight: 900;
            color: var(--text);
        }

        /* ── ABILITIES ── */
        .abilities-wrap {
            margin-top: 0.5rem;
            background: var(--cell-bg);
            border: 1px solid var(--cell-border);
            border-radius: 14px;
            padding: 0.75rem 1rem;
            transition: background 0.35s, border-color 0.35s;
        }

        .section-label {
            font-size: 0.6rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--text-2);
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .ability-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 0.4rem;
        }

        .ability-chip {
            padding: 0.25rem 0.7rem;
            border-radius: 8px;
            font-size: 0.72rem;
            font-weight: 800;
            text-transform: capitalize;
            background: var(--nav-bg);
            border: 1px solid var(--nav-border);
            color: var(--text-2);
            transition: background 0.35s, border-color 0.35s, color 0.35s;
        }

        .ability-chip.hidden-ability {
            background: rgba(251, 191, 36, 0.12);
            border-color: rgba(251, 191, 36, 0.3);
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
            color: var(--text-2);
            font-weight: 700;
            flex-shrink: 0;
            font-family: 'Space Mono', monospace;
        }

        .stat-track {
            flex: 1;
            height: 5px;
            background: var(--cell-bg);
            border-radius: 999px;
            overflow: visible;
            position: relative;
            transition: background 0.35s;
        }

        .stat-fill {
            height: 100%;
            border-radius: 999px;
            position: relative;
            animation: fillBar 1s cubic-bezier(0.16, 1, 0.3, 1) both;
            animation-delay: .2s;
        }

        @keyframes fillBar {
            from {
                width: 0 !important;
            }
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
            color: var(--text-2);
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
            border: 1px solid var(--nav-border);
            background: var(--nav-bg);
            color: var(--text-2);
            cursor: pointer;
            text-decoration: none;
            transition: background .2s, color .2s, transform .1s, border-color .2s;
        }

        .nav-btn:hover {
            background: var(--cell-bg);
            color: var(--text);
            border-color: var(--input-focus);
        }

        .nav-btn:active {
            transform: scale(0.93);
        }

        .nav-btn.accent-blue {
            background: rgba(37, 99, 235, 0.15);
            border-color: rgba(37, 99, 235, 0.3);
            color: #60a5fa;
        }

        .nav-btn.accent-blue:hover {
            background: rgba(37, 99, 235, 0.28);
            color: #93c5fd;
        }

        .nav-btn.accent-yellow {
            background: rgba(245, 158, 11, 0.12);
            border-color: rgba(245, 158, 11, 0.3);
            color: #fbbf24;
        }

        .nav-btn.accent-yellow:hover {
            background: rgba(245, 158, 11, 0.25);
            color: #fde68a;
        }

        /* ── DIVIDER ── */
        .divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--divider), transparent);
            margin: 0 1.5rem 1.25rem;
        }

        /* ── TOAST ── */
        .toast {
            margin: 0 1.5rem 1rem;
            background: rgba(239, 68, 68, 0.12);
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: 12px;
            padding: 0.6rem 1rem;
            font-size: 0.78rem;
            font-weight: 700;
            color: #fca5a5;
            text-align: center;
        }

        /* ── STAT FILLS ── */
        .hp-fill {
            background: linear-gradient(90deg, #22c55e, #86efac);
            color: #22c55e;
        }

        .atk-fill {
            background: linear-gradient(90deg, #f97316, #fdba74);
            color: #f97316;
        }

        .def-fill {
            background: linear-gradient(90deg, #3b82f6, #93c5fd);
            color: #3b82f6;
        }

        .satk-fill {
            background: linear-gradient(90deg, #a855f7, #d8b4fe);
            color: #a855f7;
        }

        .sdef-fill {
            background: linear-gradient(90deg, #ec4899, #f9a8d4);
            color: #ec4899;
        }

        .spd-fill {
            background: linear-gradient(90deg, #eab308, #fde047);
            color: #eab308;
        }

        .gen-fill {
            background: linear-gradient(90deg, #06b6d4, #67e8f9);
            color: #06b6d4;
        }
    </style>
</head>

<body>

    <div class="bg-orb bg-orb-1"></div>
    <div class="bg-orb bg-orb-2"></div>
    <div class="bg-orb bg-orb-3"></div>

    <button class="theme-btn" onclick="toggleTheme()" id="themeBtn" title="Alternar tema">☀️</button>

    <a href="/pokedex/create" class="create-tab" title="Criar novo Pokémon">
        <div class="create-tab-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
        </div>
        <span class="create-tab-text">Criar Pokémon</span>
    </a>

    @php
    $isCustom = !isset($pokemon['id']); // pokémons do banco não têm 'id' vindo da API

    $statClasses = [
    'hp' => 'hp-fill',
    'attack' => 'atk-fill',
    'defense' => 'def-fill',
    'special-attack' => 'satk-fill',
    'special-defense' => 'sdef-fill',
    'speed' => 'spd-fill',
    ];
    $statLabels = [
    'hp' => 'HP',
    'attack' => 'ATK',
    'defense' => 'DEF',
    'special-attack' => 'S.ATK',
    'special-defense' => 'S.DEF',
    'speed' => 'SPD',
    ];

    $firstType = $pokemon['types'][0]['type']['name']
    ?? (isset($pokemon['types'][0]) ? strtolower($pokemon['types'][0]) : 'normal');

    $id = $pokemon['id'] ?? $pokemon['POKE_id'] ?? null;
    $name = $pokemon['POKE_name'] ?? $pokemon['name'] ?? 'Desconhecido';
    $gen = $pokemon['POKE_generation'] ?? $pokemon['generation'] ?? 'Desconhecida';

    // Sprite normal
    $sprite = isset($pokemon['POKE_sprite']) && $pokemon['POKE_sprite']
    ? asset('storage/' . $pokemon['POKE_sprite'])
    : ($pokemon['sprites']['other']['official-artwork']['front_default'] ?? '');

    // ── FIX PROBLEMA 1: só usa shiny se for DIFERENTE do normal ──
    $spriteShinyRaw = isset($pokemon['POKE_shiny']) && $pokemon['POKE_shiny']
    ? asset('storage/' . $pokemon['POKE_shiny'])
    : ($pokemon['sprites']['other']['official-artwork']['front_shiny'] ?? null);

    // hasShiny = true somente se existir um sprite shiny distinto do normal
    $hasShiny = $spriteShinyRaw && $spriteShinyRaw !== $sprite;
    $spriteShiny = $hasShiny ? $spriteShinyRaw : $sprite;
    @endphp

    <div class="card">

        <div class="hero">
            <div class="hero-bg" style="color:var(--type-{{ $firstType }})"></div>
            <div class="pokeball-deco"></div>

            @if(isset($pokemon['POKE_name']))
            <span class="badge-id mono">#{{ str_pad($id, 4, '0', STR_PAD_LEFT) }}</span>
            @else
            <span class="badge-id mono">#{{ str_pad($id, 3, '0', STR_PAD_LEFT) }}</span>
            @endif

            <div class="poke-img-wrap" onclick="toggleShiny()">
                <div class="shiny-badge" id="shinyBadge">✨</div>

                {{-- ↓ ADICIONE ISTO — a imagem estava faltando ↓ --}}
                @if($sprite)
                <img id="poke-img" src="{{ $sprite }}" alt="{{ $name }}" class="poke-img">
                @else
                <div id="poke-img"
                    style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:72px;opacity:0.3">
                    ❓
                </div>
                @endif
                {{-- ↑ até aqui ↑ --}}

            </div>


            <h1 class="poke-name">{{ $pokemon['name'] }}</h1>
            <span class="gen-tag">{{ $gen }}</span>

            <div class="type-chips">
                @foreach ($pokemon['types'] as $tipo)
                @php
                $typeName = is_array($tipo) && isset($tipo['type']['name'])
                ? $tipo['type']['name']
                : (is_string($tipo) ? strtolower($tipo) : 'normal');
                @endphp
                <span class="chip" style="background-color:var(--type-{{ $typeName }});">
                    {{ ucfirst($typeName) }}
                </span>
                @endforeach
            </div>
        </div>

        <form action="{{ route('pokemon.index') }}" method="GET" class="search-row">
            <input type="text" name="pokemon" placeholder="Nome ou número..." class="search-input" />
            <button type="submit" class="search-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
        </form>

        <div class="info-section">
            <div class="info-grid">
                <div class="info-cell">
                    <div class="info-label">Altura</div>
                    <div class="info-value">
                        @if(isset($pokemon['height']))
                        {{ $pokemon['height'] / 10 }} m
                        @elseif(isset($pokemon['POKE_height']))
                        {{ $pokemon['POKE_height'] }} m
                        @else — @endif
                    </div>
                </div>
                <div class="info-cell">
                    <div class="info-label">Peso</div>
                    <div class="info-value">
                        @if(isset($pokemon['weight']))
                        {{ $pokemon['weight'] / 10 }} kg
                        @elseif(isset($pokemon['POKE_weight']))
                        {{ $pokemon['POKE_weight'] }} kg
                        @else — @endif
                    </div>
                </div>
                <div class="info-cell">
                    <div class="info-label">Exp.</div>
                    <div class="info-value">
                        {{ $pokemon['base_experience'] ?? $pokemon['POKE_xp'] ?? '—' }}
                    </div>
                </div>
            </div>

            <div class="abilities-wrap">
                <div class="section-label">Habilidades</div>
                <div class="ability-chips">
                    @foreach($pokemon['abilities'] as $hab)
                    @if(is_array($hab) && isset($hab['ability']['name']))
                    <span class="ability-chip {{ $hab['is_hidden'] ? 'hidden-ability' : '' }}">
                        {{ str_replace('-', ' ', $hab['ability']['name']) }}
                        @if($hab['is_hidden'])<span style="font-size:.6rem;opacity:.7;margin-left:2px;">●oculta</span>@endif
                    </span>
                    @elseif(is_string($hab))
                    <span class="ability-chip">{{ $hab }}</span>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>

        <div class="stats-section">
            @php $total = 0; @endphp
            @foreach($pokemon['stats'] as $key => $stat)
            @php
            // PokéAPI: [{base_stat: 45, stat: {name: 'hp'}}, ...]
            if (is_array($stat) && isset($stat['base_stat'])) {
            $val = $stat['base_stat'];
            $statName = $stat['stat']['name'];
            }
            // Banco de dados (com cast array): ['hp' => 50, 'attack' => 80, ...]
            else {
            $val = (int) $stat;
            $statName = $key; // a chave já é 'hp', 'attack', etc.
            }

            $total += $val;
            $label = $statLabels[$statName] ?? strtoupper(substr($statName, 0, 3));
            $fillClass = $statClasses[$statName] ?? 'gen-fill';
            $pct = min(($val / 255) * 100, 100);
            @endphp
            <div class="stat-row">
                <span class="stat-name">{{ $label }}</span>
                <div class="stat-track">
                    <div class="stat-fill {{ $fillClass }}" style="width:{{ $pct }}%"></div>
                </div>
                <span class="stat-num">{{ $val }}</span>
            </div>
            @endforeach
            <div class="stat-row" style="margin-top:.75rem;padding-top:.75rem;border-top:1px solid var(--divider);">
                <span class="stat-name" style="color:var(--text-2);">TOTAL</span>
                <div style="flex:1"></div>
                <span class="stat-num" style="color:var(--text);font-size:.78rem;">{{ $total }}</span>
            </div>
        </div>

        <div class="divider"></div>

        <div class="bottom-nav">
            <a href="{{ route('pokemon.index', ['pokemon' => ($pokemon['id'] ?? 2) - 1]) }}" class="nav-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>

            <button onclick="playCry()" class="nav-btn accent-blue" title="Ouvir grito" style="width:46px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" />
                </svg>
            </button>

            <button
                onclick="{{ $hasShiny ? 'toggleShiny()' : 'void(0)' }}"
                class="nav-btn accent-yellow {{ $hasShiny ? '' : 'opacity-40 cursor-not-allowed' }}"
                title="{{ $hasShiny ? 'Versão shiny' : 'Sem sprite shiny' }}"
                style="width:46px;"
                {{ $hasShiny ? '' : 'disabled' }}>
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2l2.4 7.2h7.6l-6.1 4.5 2.3 7.3-6.2-4.6-6.2 4.6 2.3-7.3-6.1-4.5h7.6z" />
                </svg>
            </button>

            <a href="{{ route('pokemon.index', ['pokemon' => ($pokemon['id'] ?? 0) + 1]) }}" class="nav-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        @if(session('Erro'))
        <div class="toast">⚠️ {{ session('Erro') }}</div>
        @endif

    </div>

    @if(isset($pokemon['cries']['latest']))
    <audio id="poke-cry" src="{{ $pokemon['cries']['latest'] }}"></audio>
    @elseif(isset($pokemon['POKE_audio']))
    <audio id="poke-cry" src="{{ asset('storage/' . $pokemon['POKE_audio']) }}"></audio>
    @endif

    <script>
        /* ── THEME ── */
        const root = document.documentElement;
        const tBtn = document.getElementById('themeBtn');

        function applyTheme(t) {
            root.setAttribute('data-theme', t);
            tBtn.textContent = t === 'dark' ? '☀️' : '🌙';
            localStorage.setItem('pkedex-theme', t);
        }

        function toggleTheme() {
            applyTheme(root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark');
        }

        applyTheme(localStorage.getItem('pkedex-theme') || 'dark');

        /* ── SHINY ── */
        let isShiny = false;
        const imgEl = document.getElementById('poke-img');
        const badgeEl = document.getElementById('shinyBadge');
        const normalSrc = @json($sprite);
        const shinySrc = @json($spriteShiny);

        function toggleShiny() {
            if (!imgEl || imgEl.tagName !== 'IMG') return;
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

        if (imgEl && imgEl.tagName === 'IMG') {
            imgEl.style.transition = 'opacity .22s ease, transform .22s ease';
        }

        /* ── CRY ── */
        function playCry() {
            const a = document.getElementById('poke-cry');
            if (a) {
                a.currentTime = 0;
                a.volume = 0.5;
                a.play();
            }
        }
    </script>
</body>

</html>