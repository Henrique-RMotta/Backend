<!DOCTYPE html>
<html lang="pt-BR" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="/favicon.png">
    <title>Nova Entrada — Pokédex</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* ══════════════════════════════════════
           THEME TOKENS — padronizado com show.blade
        ══════════════════════════════════════ */
        :root {
            --red: #e53935;
            --red-glow: rgba(229, 57, 53, 0.28);
            --red-dim: rgba(229, 57, 53, 0.10);
        }

        [data-theme="dark"] {
            --bg: #0f0f1a;
            --surface: rgba(18, 18, 30, 0.9);
            --surface2: rgba(255, 255, 255, 0.04);
            --surface3: rgba(255, 255, 255, 0.07);
            --border: rgba(255, 255, 255, 0.08);
            --border-mid: rgba(255, 255, 255, 0.14);
            --text: #ffffff;
            --text-2: rgba(255, 255, 255, 0.55);
            --text-3: rgba(255, 255, 255, 0.28);
            --input-bg: rgba(255, 255, 255, 0.05);
            --input-focus: rgba(255, 255, 255, 0.10);
            --card-shadow: 0 24px 64px rgba(0, 0, 0, 0.7), inset 0 1px 0 rgba(255, 255, 255, 0.07);
            --orb-op: 0.12;
            --done-bg: rgba(34, 197, 94, 0.12);
            --done-c: #4ade80;
        }

        [data-theme="light"] {
            --bg: #f0f0f5;
            --surface: rgba(255, 255, 255, 0.92);
            --surface2: rgba(0, 0, 0, 0.03);
            --surface3: rgba(0, 0, 0, 0.06);
            --border: rgba(0, 0, 0, 0.07);
            --border-mid: rgba(0, 0, 0, 0.13);
            --text: #111118;
            --text-2: rgba(0, 0, 0, 0.45);
            --text-3: rgba(0, 0, 0, 0.25);
            --input-bg: rgba(0, 0, 0, 0.04);
            --input-focus: rgba(0, 0, 0, 0.07);
            --card-shadow: 0 16px 48px rgba(0, 0, 0, 0.12), inset 0 1px 0 rgba(255, 255, 255, 0.8);
            --orb-op: 0.06;
            --done-bg: rgba(22, 163, 74, 0.10);
            --done-c: #16a34a;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding: 40px 20px 80px;
            transition: background 0.35s, color 0.35s;
            overflow-x: hidden;
        }

        /* ── BG ORBS (igual à show page) ── */
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

        /* ── THEME BUTTON ── */
        .theme-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            width: 42px;
            height: 42px;
            border-radius: 12px;
            border: 1px solid var(--border-mid);
            background: var(--surface);
            backdrop-filter: blur(12px);
            cursor: pointer;
            font-size: 18px;
            z-index: 200;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .theme-btn:hover {
            transform: scale(1.1);
        }

        /* ── LAYOUT ── */
        .page-wrapper {
            width: 100%;
            max-width: 900px;
            display: grid;
            grid-template-columns: 210px 1fr;
            gap: 20px;
            align-items: start;
            position: relative;
            z-index: 1;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            position: sticky;
            top: 40px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 22px 18px;
            backdrop-filter: blur(24px);
            box-shadow: var(--card-shadow);
            overflow: hidden;
        }

        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--red);
            border-radius: 24px 24px 0 0;
        }

        .poke-label {
            font-family: 'Space Mono', monospace;
            font-size: 9px;
            color: var(--red);
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .poke-label::before {
            content: '';
            width: 6px;
            height: 6px;
            background: var(--red);
            border-radius: 50%;
            box-shadow: 0 0 8px var(--red);
            animation: blink 2s ease-in-out infinite;
            flex-shrink: 0;
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1
            }

            50% {
                opacity: .3
            }
        }

        .step-list {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .step-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 10px;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.25s;
            border: 1px solid transparent;
        }

        .step-item.done {
            background: var(--done-bg);
        }

        .step-item.active {
            background: var(--red-dim);
            border-color: rgba(229, 57, 53, .35);
        }

        .step-num {
            width: 26px;
            height: 26px;
            border-radius: 8px;
            background: var(--surface3);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Space Mono', monospace;
            font-size: 10px;
            color: var(--text-2);
            flex-shrink: 0;
            transition: all 0.25s;
        }

        .step-item.done .step-num {
            background: var(--done-bg);
            border-color: var(--done-c);
            color: var(--done-c);
        }

        .step-item.active .step-num {
            background: var(--red);
            border-color: var(--red);
            color: #fff;
        }

        .step-info {
            flex: 1;
            min-width: 0;
        }

        .step-name {
            font-size: 12px;
            font-weight: 800;
            color: var(--text-2);
            transition: color .2s;
        }

        .step-item.active .step-name {
            color: var(--text);
        }

        .step-item.done .step-name {
            color: var(--done-c);
        }

        .step-desc {
            font-size: 10px;
            color: var(--text-3);
            margin-top: 1px;
        }

        .prog-wrap {
            margin-top: 20px;
            padding-top: 16px;
            border-top: 1px solid var(--border);
        }

        .prog-meta {
            display: flex;
            justify-content: space-between;
            font-family: 'Space Mono', monospace;
            font-size: 9px;
            color: var(--text-3);
            margin-bottom: 7px;
        }

        .prog-track {
            height: 4px;
            background: var(--surface3);
            border-radius: 4px;
            overflow: hidden;
        }

        .prog-fill {
            height: 100%;
            background: var(--red);
            border-radius: 4px;
            transition: width .5s cubic-bezier(.4, 0, .2, 1);
            box-shadow: 0 0 8px var(--red-glow);
        }

        /* ── MAIN CARD ── */
        .main-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 24px;
            backdrop-filter: blur(24px);
            box-shadow: var(--card-shadow);
            overflow: hidden;
            transition: background .35s;
        }

        .card-header {
            padding: 26px 28px 22px;
            border-bottom: 1px solid var(--border);
        }

        .card-header h1 {
            font-size: 20px;
            font-weight: 900;
            color: var(--text);
        }

        .card-header p {
            font-size: 13px;
            color: var(--text-2);
            margin-top: 3px;
            font-weight: 600;
        }

        .card-body {
            padding: 24px 28px;
        }

        /* ── FORM STEPS ── */
        .form-step {
            display: none;
        }

        .form-step.active {
            display: block;
            animation: fadeUp .35s cubic-bezier(.4, 0, .2, 1);
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(14px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ── FIELDS ── */
        .field {
            margin-bottom: 20px;
        }

        .field-label {
            display: block;
            font-size: 10px;
            font-weight: 800;
            color: var(--text-2);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 8px;
        }

        .field-input {
            width: 100%;
            background: var(--input-bg);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 11px 14px;
            color: var(--text);
            font-family: 'Nunito', sans-serif;
            font-size: 15px;
            font-weight: 700;
            outline: none;
            appearance: none;
            transition: border-color .2s, background .2s, box-shadow .2s;
        }

        .field-input:focus {
            border-color: rgba(229, 57, 53, .5);
            background: var(--input-focus);
            box-shadow: 0 0 0 3px var(--red-dim);
        }

        .field-input::placeholder {
            color: var(--text-3);
            font-weight: 600;
        }

        .field-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .field-hint {
            font-size: 11px;
            color: var(--text-3);
            margin-top: 5px;
            font-weight: 600;
        }

        .sec-title {
            font-family: 'Space Mono', monospace;
            font-size: 9px;
            color: var(--red);
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .sec-title::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        /* ── GEN GRID ── */
        .gen-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 7px;
        }

        .gen-option input {
            display: none;
        }

        .gen-card {
            display: block;
            text-align: center;
            padding: 11px 6px;
            background: var(--input-bg);
            border: 1px solid var(--border);
            border-radius: 10px;
            cursor: pointer;
            font-family: 'Space Mono', monospace;
            font-size: 11px;
            color: var(--text-2);
            font-weight: 700;
            transition: all .2s;
            user-select: none;
        }

        .gen-card:hover {
            border-color: var(--border-mid);
            color: var(--text);
        }

        .gen-option input:checked+.gen-card {
            background: var(--red-dim);
            border-color: rgba(229, 57, 53, .5);
            color: var(--text);
            box-shadow: 0 0 12px var(--red-glow);
        }

        /* ══════════════════════════════════════
           TYPE CARDS — visual, estilo game
        ══════════════════════════════════════ */
        .type-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .type-option input {
            display: none;
        }

        .type-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
            padding: 14px 6px 11px;
            border-radius: 14px;
            cursor: pointer;
            border: 2px solid var(--border);
            transition: all .25s cubic-bezier(.34, 1.3, .64, 1);
            position: relative;
            overflow: hidden;
            user-select: none;
            background: var(--input-bg);
        }

        .type-card-bg {
            position: absolute;
            inset: 0;
            opacity: 0.10;
            transition: opacity .25s;
        }

        [data-theme="light"] .type-card-bg {
            opacity: 0.06;
        }

        .type-card-art {
            font-size: 28px;
            line-height: 1;
            filter: grayscale(.6) brightness(.7);
            transition: filter .25s, transform .25s;
            position: relative;
            z-index: 1;
        }

        .type-card-name {
            font-size: 9px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: .1em;
            color: var(--text-3);
            position: relative;
            z-index: 1;
            transition: color .2s;
        }

        .type-card-desc {
            font-size: 9px;
            font-weight: 600;
            color: var(--text-3);
            position: relative;
            z-index: 1;
            text-align: center;
            line-height: 1.3;
            transition: color .2s;
            display: none;
            /* shown on checked */
        }

        .type-card:hover {
            border-color: var(--border-mid);
        }

        .type-card:hover .type-card-art {
            filter: grayscale(.2) brightness(.85);
            transform: scale(1.1) translateY(-2px);
        }

        .type-option input:checked+.type-card {
            transform: scale(1.06) translateY(-3px);
            box-shadow: 0 10px 28px rgba(0, 0, 0, .22);
        }

        .type-option input:checked+.type-card .type-card-bg {
            opacity: .32;
        }

        [data-theme="light"] .type-option input:checked+.type-card .type-card-bg {
            opacity: .16;
        }

        .type-option input:checked+.type-card .type-card-art {
            filter: grayscale(0) brightness(1);
        }

        .type-option input:checked+.type-card .type-card-name {
            color: var(--text);
        }

        /* type border + bg colors */
        .tc-normal {
            --tc: #a8a878;
        }

        .tb-normal {
            background: #a8a878;
        }

        .tc-fire {
            --tc: #f08030;
        }

        .tb-fire {
            background: #f08030;
        }

        .tc-water {
            --tc: #6890f0;
        }

        .tb-water {
            background: #6890f0;
        }

        .tc-grass {
            --tc: #78c850;
        }

        .tb-grass {
            background: #78c850;
        }

        .tc-electric {
            --tc: #f8d030;
        }

        .tb-electric {
            background: #f8d030;
        }

        .tc-ice {
            --tc: #98d8d8;
        }

        .tb-ice {
            background: #98d8d8;
        }

        .tc-fighting {
            --tc: #c03028;
        }

        .tb-fighting {
            background: #c03028;
        }

        .tc-poison {
            --tc: #a040a0;
        }

        .tb-poison {
            background: #a040a0;
        }

        .tc-ground {
            --tc: #e0c068;
        }

        .tb-ground {
            background: #e0c068;
        }

        .tc-flying {
            --tc: #a890f0;
        }

        .tb-flying {
            background: #a890f0;
        }

        .tc-psychic {
            --tc: #f85888;
        }

        .tb-psychic {
            background: #f85888;
        }

        .tc-bug {
            --tc: #a8b820;
        }

        .tb-bug {
            background: #a8b820;
        }

        .tc-rock {
            --tc: #b8a038;
        }

        .tb-rock {
            background: #b8a038;
        }

        .tc-ghost {
            --tc: #705898;
        }

        .tb-ghost {
            background: #705898;
        }

        .tc-dragon {
            --tc: #7038f8;
        }

        .tb-dragon {
            background: #7038f8;
        }

        .tc-dark {
            --tc: #705848;
        }

        .tb-dark {
            background: #705848;
        }

        .tc-steel {
            --tc: #b8b8d0;
        }

        .tb-steel {
            background: #b8b8d0;
        }

        .tc-fairy {
            --tc: #ee99ac;
        }

        .tb-fairy {
            background: #ee99ac;
        }

        .type-option input:checked+.type-card {
            border-color: var(--tc) !important;
        }

        .type-option input:not(:checked)+.type-card {
            border-color: var(--border);
        }

        /* ── ABILITIES ── */
        .ability-row {
            display: flex;
            gap: 8px;
            margin-bottom: 8px;
        }

        .ability-row .field-input {
            flex: 1;
        }

        .btn-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            border: 1px solid var(--border);
            background: var(--input-bg);
            color: var(--text-2);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 20px;
            flex-shrink: 0;
            transition: all .2s;
            line-height: 1;
        }

        .btn-icon.add:hover {
            border-color: rgba(34, 197, 94, .5);
            color: #4ade80;
            background: rgba(34, 197, 94, .08);
        }

        .btn-icon.rem:hover {
            border-color: rgba(239, 68, 68, .5);
            color: #f87171;
            background: rgba(239, 68, 68, .08);
        }

        /* ── STATS ── */
        .stat-row {
            display: grid;
            grid-template-columns: 90px 1fr 44px;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
        }

        .stat-name {
            font-family: 'Space Mono', monospace;
            font-size: 9px;
            color: var(--text-2);
            text-transform: uppercase;
            font-weight: 700;
        }

        input[type="range"] {
            -webkit-appearance: none;
            width: 100%;
            height: 5px;
            border-radius: 5px;
            background: var(--surface3);
            outline: none;
            cursor: pointer;
        }

        input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: var(--text);
            border: 3px solid var(--bg);
            box-shadow: 0 0 0 2px var(--red);
            cursor: pointer;
            transition: transform .15s;
        }

        input[type="range"]::-webkit-slider-thumb:hover {
            transform: scale(1.25);
        }

        .stat-val {
            font-family: 'Space Mono', monospace;
            font-size: 12px;
            font-weight: 700;
            color: var(--red);
            text-align: right;
        }

        /* ── SHINY ── */
        .shiny-wrap input {
            display: none;
        }

        .shiny-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 11px 18px;
            background: var(--input-bg);
            border: 1px solid var(--border);
            border-radius: 12px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 800;
            color: var(--text-2);
            transition: all .25s;
            user-select: none;
        }

        .shiny-icon {
            font-size: 18px;
            transition: transform .35s;
        }

        .shiny-wrap input:checked+.shiny-btn {
            background: rgba(251, 191, 36, .1);
            border-color: rgba(251, 191, 36, .45);
            color: #fbbf24;
            box-shadow: 0 0 16px rgba(251, 191, 36, .12);
        }

        .shiny-wrap input:checked+.shiny-btn .shiny-icon {
            transform: rotate(180deg) scale(1.3);
        }

        /* ── FILE UPLOAD ── */
        .file-upload {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 24px;
            background: var(--input-bg);
            border: 1px dashed var(--border-mid);
            border-radius: 14px;
            cursor: pointer;
            transition: all .2s;
            text-align: center;
            position: relative;
        }

        .file-upload:hover {
            border-color: rgba(229, 57, 53, .4);
            background: var(--red-dim);
        }

        .file-upload input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }

        .file-upload-icon {
            font-size: 26px;
        }

        .file-upload-label {
            font-size: 13px;
            font-weight: 800;
            color: var(--text);
        }

        .file-upload-hint {
            font-size: 11px;
            color: var(--text-3);
            font-weight: 600;
        }

        /* ── ERRORS ── */
        .errors {
            margin: 20px 28px 0;
            background: rgba(229, 57, 53, .08);
            border: 1px solid rgba(229, 57, 53, .25);
            border-radius: 12px;
            padding: 14px 18px;
        }

        .errors strong {
            display: block;
            color: #ef5350;
            font-size: 12px;
            margin-bottom: 6px;
            font-weight: 800;
        }

        .errors ul {
            padding-left: 14px;
        }

        .errors li {
            font-size: 12px;
            color: var(--text-2);
            margin-bottom: 3px;
            font-weight: 600;
        }

        /* ── FOOTER ── */
        .card-footer {
            padding: 18px 28px;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 10px 20px;
            border-radius: 12px;
            font-family: 'Nunito', sans-serif;
            font-size: 13px;
            font-weight: 800;
            cursor: pointer;
            border: none;
            outline: none;
            transition: all .2s;
        }

        .btn-ghost {
            background: transparent;
            color: var(--text-2);
            border: 1px solid var(--border);
        }

        .btn-ghost:hover {
            background: var(--surface2);
            color: var(--text);
        }

        .btn-primary {
            background: var(--red);
            color: #fff;
            box-shadow: 0 4px 14px var(--red-glow);
        }

        .btn-primary:hover {
            background: #ef5350;
            transform: translateY(-1px);
            box-shadow: 0 6px 18px var(--red-glow);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-success {
            background: #16a34a;
            color: #fff;
            box-shadow: 0 4px 14px rgba(22, 163, 74, .28);
        }

        .btn-success:hover {
            background: #15803d;
            transform: translateY(-1px);
        }
    </style>
</head>

<body>

    <div class="bg-orb bg-orb-1"></div>
    <div class="bg-orb bg-orb-2"></div>
    <div class="bg-orb bg-orb-3"></div>

    <button class="theme-btn" onclick="toggleTheme()" id="themeBtn" title="Alternar tema">☀️</button>

    <div class="page-wrapper">

        <!-- ── SIDEBAR ── -->
        <aside class="sidebar">
            <div class="poke-label">Pokédex</div>
            <nav class="step-list">
                <div class="step-item active" data-step="1">
                    <div class="step-num">01</div>
                    <div class="step-info">
                        <div class="step-name">Perfil</div>
                        <div class="step-desc">Nome, XP, geração</div>
                    </div>
                </div>
                <div class="step-item" data-step="2">
                    <div class="step-num">02</div>
                    <div class="step-info">
                        <div class="step-name">Físico</div>
                        <div class="step-desc">Altura, peso, shiny</div>
                    </div>
                </div>
                <div class="step-item" data-step="3">
                    <div class="step-num">03</div>
                    <div class="step-info">
                        <div class="step-name">Batalha</div>
                        <div class="step-desc">Tipo, stats, skills</div>
                    </div>
                </div>
                <div class="step-item" data-step="4">
                    <div class="step-num">04</div>
                    <div class="step-info">
                        <div class="step-name">Mídia</div>
                        <div class="step-desc">Sprite, áudio</div>
                    </div>
                </div>
            </nav>
            <div class="prog-wrap">
                <div class="prog-meta"><span>PROGRESSO</span><span id="pct-label">25%</span></div>
                <div class="prog-track">
                    <div class="prog-fill" id="prog-fill" style="width:25%"></div>
                </div>
            </div>
        </aside>

        <!-- ── MAIN CARD ── -->
        <div class="main-card">
            <div class="card-header">
                <h1 id="step-title">Identidade</h1>
                <p id="step-sub">Defina o nome e a origem desse Pokémon</p>
            </div>

            @if ($errors->any())
            <div class="errors">
                <strong>Corrige aí antes de continuar:</strong>
                <ul>@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
            @endif

            <form action="{{ route('pokemon.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- ═══ STEP 1: PERFIL ═══ -->
                <div class="form-step active" id="step-1">
                    <div class="card-body">
                        <div class="sec-title">Identidade</div>

                        <div class="field">
                            <label class="field-label">Nome do Pokémon</label>
                            <input class="field-input" type="text" name="POKE_name" required placeholder="Ex: Charizard" value="{{ old('POKE_name') }}">
                        </div>

                        <div class="field">
                            <label class="field-label">Experiência Base (XP)</label>
                            <input class="field-input" type="number" name="POKE_xp" required placeholder="Ex: 240" value="{{ old('POKE_xp') }}">
                            <div class="field-hint">XP que o oponente ganha ao derrotar esse Pokémon.</div>
                        </div>

                        <div class="field">
                            <label class="field-label">Geração</label>
                            <div class="gen-grid">
                                @for ($i=1; $i<=9; $i++)
                                    <label class="gen-option">
                                    <input type="radio" name="POKE_generation" value="Gen {{ $i }}" required {{ old('POKE_generation')=='Gen '.$i ? 'checked' : '' }}>
                                    <span class="gen-card">Gen {{ $i }}</span>
                                    </label>
                                    @endfor
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ═══ STEP 2: FÍSICO ═══ -->
                <div class="form-step" id="step-2">
                    <div class="card-body">
                        <div class="sec-title">Dados Físicos</div>

                        <div class="field-row field">
                            <div>
                                <label class="field-label">Altura (m)</label>
                                <input class="field-input" type="number" step="0.1" name="POKE_height" required placeholder="1.7" value="{{ old('POKE_height') }}">
                            </div>
                            <div>
                                <label class="field-label">Peso (kg)</label>
                                <input class="field-input" type="number" step="0.1" name="POKE_weight" required placeholder="90.5" value="{{ old('POKE_weight') }}">
                            </div>
                        </div>

                        <div class="field">
                            <div class="sec-title">Shiny</div>
                            <div class="field">
                                <label class="file-upload" id="upload-shiny">
                                    <input type="file" name="POKE_shiny" accept="image/*"
                                        onchange="handleUpload(this, 'shiny-lbl', 'shiny-preview')">
                                    <img id="shiny-preview" src="" alt=""
                                        style="display:none;max-height:80px;border-radius:8px;margin-bottom:6px;">
                                    <div class="file-upload-icon" id="shiny-icon">🖼️</div>
                                    <div class="file-upload-label" id="shiny-lbl">Solte aqui ou clique para escolher</div>
                                    <div class="file-upload-hint">PNG, GIF, WEBP — recomendado 256×256</div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ═══ STEP 3: BATALHA ═══ -->
                <div class="form-step" id="step-3">
                    <div class="card-body">
                        <div class="sec-title">Tipo / Elemento</div>

                        <div class="field">
                            @php
                            $types = [
                            ['v'=>'Normal', 'l'=>'Normal', 'art'=>'⬜','d'=>'Sem fraqueza especial', 'c'=>'normal'],
                            ['v'=>'Fire', 'l'=>'Fogo', 'art'=>'🔥','d'=>'Queima adversários', 'c'=>'fire'],
                            ['v'=>'Water', 'l'=>'Água', 'art'=>'💧','d'=>'Apaga o fogo', 'c'=>'water'],
                            ['v'=>'Grass', 'l'=>'Planta', 'art'=>'🌿','d'=>'Energia da natureza', 'c'=>'grass'],
                            ['v'=>'Electric', 'l'=>'Elétrico', 'art'=>'⚡','d'=>'Velocidade e choque', 'c'=>'electric'],
                            ['v'=>'Ice', 'l'=>'Gelo', 'art'=>'❄️','d'=>'Congela o oponente', 'c'=>'ice'],
                            ['v'=>'Fighting', 'l'=>'Lutador', 'art'=>'🥊','d'=>'Força bruta física', 'c'=>'fighting'],
                            ['v'=>'Poison', 'l'=>'Veneno', 'art'=>'☠️','d'=>'Envenena e corrói', 'c'=>'poison'],
                            ['v'=>'Ground', 'l'=>'Terra', 'art'=>'🏜️','d'=>'Domina o terreno', 'c'=>'ground'],
                            ['v'=>'Flying', 'l'=>'Voador', 'art'=>'🦅','d'=>'Ataca do alto', 'c'=>'flying'],
                            ['v'=>'Psychic', 'l'=>'Psíquico', 'art'=>'🧠','d'=>'Poder mental', 'c'=>'psychic'],
                            ['v'=>'Bug', 'l'=>'Inseto', 'art'=>'🐛','d'=>'Ágil e certeiro', 'c'=>'bug'],
                            ['v'=>'Rock', 'l'=>'Pedra', 'art'=>'🗿','d'=>'Defesa sólida', 'c'=>'rock'],
                            ['v'=>'Ghost', 'l'=>'Fantasma', 'art'=>'👻','d'=>'Imaterial e assombra', 'c'=>'ghost'],
                            ['v'=>'Dragon', 'l'=>'Dragão', 'art'=>'🐉','d'=>'Poder ancestral', 'c'=>'dragon'],
                            ['v'=>'Dark', 'l'=>'Sombrio', 'art'=>'🌑','d'=>'Estratégias traiçoeiras', 'c'=>'dark'],
                            ['v'=>'Steel', 'l'=>'Aço', 'art'=>'⚙️','d'=>'Resistência máxima', 'c'=>'steel'],
                            ['v'=>'Fairy', 'l'=>'Fada', 'art'=>'✨','d'=>'Mágico e encantador', 'c'=>'fairy'],
                            ];
                            @endphp

                            <div class="type-grid">
                                @foreach ($types as $t)
                                <label class="type-option">
                                    <input type="checkbox" name="POKE_elements[]" value="{{ $t['v'] }}" class="type-cb">
                                    <div class="type-card tc-{{ $t['c'] }}">
                                        <div class="type-card-bg tb-{{ $t['c'] }}"></div>
                                        <div class="type-card-art">{{ $t['art'] }}</div>
                                        <div class="type-card-name">{{ $t['l'] }}</div>
                                    </div>
                                </label>
                                @endforeach
                            </div>
                            <div class="field-hint" style="margin-top:10px;">Escolha até 2 tipos.</div>
                        </div>

                        <div class="sec-title" style="margin-top:4px;">Habilidades</div>

                        <div class="field" id="abil-wrap">
                            <div class="ability-row">
                                <input class="field-input" type="text" name="POKE_abilities[]" required placeholder="Ex: Blaze">
                                <button type="button" class="btn-icon add" onclick="addAbility()" title="Adicionar">+</button>
                            </div>
                        </div>

                        <div class="sec-title">Status Base</div>
                        <div class="field">
                            @php $stats=[['k'=>'hp','l'=>'❤️ HP'],['k'=>'attack','l'=>'⚔️ Ataque'],['k'=>'defense','l'=>'🛡️ Defesa'],['k'=>'speed','l'=>'💨 Velocidade']]; @endphp
                            @foreach ($stats as $s)
                            <div class="stat-row">
                                <div class="stat-name">{{ $s['l'] }}</div>
                                <input type="range" name="POKE_stats[{{ $s['k'] }}]" min="1" max="255" value="50"
                                    id="sl-{{ $s['k'] }}" oninput="updStat('{{ $s['k'] }}',this.value,this)">
                                <div class="stat-val" id="sv-{{ $s['k'] }}">50</div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- ═══ STEP 4: MÍDIA ═══ -->
                <div class="form-step" id="step-4">
                    <div class="card-body">
                        <div class="sec-title">Sprite</div>
                        <div class="field">
                            <label class="file-upload" id="upload-sprite">
                                <input type="file" name="POKE_sprite" accept="image/*"
                                    onchange="handleUpload(this, 'sprite-lbl', 'sprite-preview')">
                                <img id="sprite-preview" src="" alt=""
                                    style="display:none;max-height:80px;border-radius:8px;margin-bottom:6px;">
                                <div class="file-upload-icon" id="sprite-icon">🖼️</div>
                                <div class="file-upload-label" id="sprite-lbl">Solte aqui ou clique para escolher</div>
                                <div class="file-upload-hint">PNG, GIF, WEBP — recomendado 256×256</div>
                            </label>
                        </div>
                        <div class="sec-title">Áudio</div>
                        <div class="field">
                            <label class="file-upload">
                                <input type="file" name="POKE_audio" accept="audio/*" onchange="setLbl(this,'aud-lbl')">
                                <div class="file-upload-icon">🎵</div>
                                <div class="file-upload-label" id="aud-lbl">Solte aqui ou clique para escolher</div>
                                <div class="file-upload-hint">MP3, OGG, WAV — grito ou tema</div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- ── FOOTER ── -->
                <div class="card-footer">
                    <button type="button" class="btn btn-ghost" id="btn-prev" onclick="prevStep()" style="visibility:hidden">← Voltar</button>
                    <button type="button" class="btn btn-primary" id="btn-next" onclick="nextStep()">Próximo →</button>
                    <button type="submit" class="btn btn-success" id="btn-submit" style="display:none">💾 Salvar na Pokédex</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        /* ─ THEME ─ */
        const root = document.documentElement;
        const tBtn = document.getElementById('themeBtn');
        const saved = localStorage.getItem('pkedex-theme');

        function applyTheme(t) {
            root.setAttribute('data-theme', t);
            tBtn.textContent = t === 'dark' ? '☀️' : '🌙';
            localStorage.setItem('pkedex-theme', t);
        }

        function toggleTheme() {
            applyTheme(root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark');
        }

        applyTheme(saved || 'dark');

        /* ─ STEPPER ─ */
        const META = [{
                title: 'Identidade',
                sub: 'Defina o nome e a origem desse Pokémon'
            },
            {
                title: 'Dados Físicos',
                sub: 'Medidas corporais e raridade'
            },
            {
                title: 'Batalha',
                sub: 'Tipo, habilidades e distribuição de stats'
            },
            {
                title: 'Mídia',
                sub: 'Sprite e grito do Pokémon'
            },
        ];

        let cur = 1;
        const N = 4;

        function renderUI() {
            for (let i = 1; i <= N; i++) {
                document.getElementById('step-' + i).classList.toggle('active', i === cur);
            }
            document.querySelectorAll('.step-item').forEach((el, i) => {
                el.classList.remove('active', 'done');
                if (i + 1 === cur) el.classList.add('active');
                else if (i + 1 < cur) el.classList.add('done');
            });
            const pct = Math.round(cur / N * 100);
            document.getElementById('prog-fill').style.width = pct + '%';
            document.getElementById('pct-label').textContent = pct + '%';
            document.getElementById('step-title').textContent = META[cur - 1].title;
            document.getElementById('step-sub').textContent = META[cur - 1].sub;
            document.getElementById('btn-prev').style.visibility = cur === 1 ? 'hidden' : 'visible';
            document.getElementById('btn-next').style.display = cur === N ? 'none' : 'inline-flex';
            document.getElementById('btn-submit').style.display = cur === N ? 'inline-flex' : 'none';
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        function nextStep() {
            const stepEl = document.getElementById('step-' + cur);
            let ok = true;
            stepEl.querySelectorAll('input[required]').forEach(inp => {
                if (!inp.checkValidity()) {
                    inp.reportValidity();
                    ok = false;
                }
            });
            if (!ok) return;
            if (cur < N) {
                cur++;
                renderUI();
            }
        }

        function prevStep() {
            if (cur > 1) {
                cur--;
                renderUI();
            }
        }

        document.querySelectorAll('.step-item').forEach(el => {
            el.addEventListener('click', () => {
                const t = parseInt(el.dataset.step);
                if (t < cur) {
                    cur = t;
                    renderUI();
                }
            });
        });

        /* ─ SLIDERS ─ */
        function updStat(k, v, el) {
            document.getElementById('sv-' + k).textContent = v;
            const p = Math.round((v - 1) / 254 * 100);
            const c = p < 34 ? '#e53935' : p < 67 ? '#f59e0b' : '#22c55e';
            el.style.background = `linear-gradient(to right,${c} ${p}%,var(--surface3) ${p}%)`;
        }

        document.querySelectorAll('input[type="range"]').forEach(s => {
            const k = s.id.replace('sl-', '');
            updStat(k, s.value, s);
            s.addEventListener('input', function() {
                updStat(k, this.value, this);
            });
        });

        /* ─ ABILITIES ─ */
        function addAbility() {
            const c = document.getElementById('abil-wrap');
            const r = document.createElement('div');
            r.className = 'ability-row';
            r.innerHTML = `<input class="field-input" type="text" name="POKE_abilities[]" required placeholder="Nova habilidade">
                     <button type="button" class="btn-icon rem" onclick="this.parentElement.remove()">×</button>`;
            c.appendChild(r);
            r.querySelector('input').focus();
        }

        /* ─ TYPE LIMIT ─ */
        document.querySelectorAll('.type-cb').forEach(cb => {
            cb.addEventListener('change', function() {
                if (document.querySelectorAll('.type-cb:checked').length > 2) this.checked = false;
            });
        });

        /* ─ FILE LABELS ─ */
        function handleUpload(inp, lblId, previewId) {
            const file = inp.files?.[0];
            if (!file) return;
            document.getElementById(lblId).textContent = file.name;

            // Preview ao vivo
            const reader = new FileReader();
            reader.onload = e => {
                const img = document.getElementById(previewId);
                img.src = e.target.result;
                img.style.display = 'block';
                // Esconde o ícone emoji quando há preview
                const icon = inp.closest('.file-upload').querySelector('.file-upload-icon');
                if (icon) icon.style.display = 'none';
            };
            reader.readAsDataURL(file);
        }

        renderUI();
    </script>
</body>

</html>