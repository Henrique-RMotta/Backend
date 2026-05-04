<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Pokémon - Pokédex</title>
    <style>
        :root { --pokedex-red: #e3350d; --bg-color: #f0f0f0; --card-bg: #ffffff; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: var(--bg-color); padding: 20px; color: #333; }
        .container { max-width: 650px; margin: 0 auto; background: var(--card-bg); padding: 30px; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); border: 4px solid var(--pokedex-red); }
        
        h2 { text-align: center; color: var(--pokedex-red); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 25px;}

        /* Stepper Styles */
        .stepper { display: flex; justify-content: space-between; margin-bottom: 30px; border-bottom: 2px solid #eee; }
        .step { flex: 1; text-align: center; color: #aaa; padding-bottom: 10px; font-weight: bold; transition: 0.3s; }
        .step.active { color: var(--pokedex-red); border-bottom: 3px solid var(--pokedex-red); }
        
        /* Form Steps */
        .form-step { display: none; animation: fadeIn 0.4s; }
        .form-step.active { display: block; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        
        /* Inputs Padroes */
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; font-weight: bold; color: #555; }
        input[type="text"], input[type="number"], input[type="file"] { width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; box-sizing: border-box; transition: border 0.3s; font-size: 15px;}
        input[type="text"]:focus, input[type="number"]:focus { border-color: var(--pokedex-red); outline: none; }

        /* --- ELEMENTOS INTERATIVOS --- */
        .hidden-input { display: none; }

        /* Grid de Geração */
        .gen-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; }
        .gen-card { background: #f9f9f9; border: 2px solid #ddd; border-radius: 8px; padding: 10px; text-align: center; cursor: pointer; transition: 0.2s; font-weight: bold; }
        .gen-card:hover { background: #fee; }
        input[type="radio"]:checked + .gen-card { background: var(--pokedex-red); color: white; border-color: #c02a0a; transform: scale(1.05); }

        /* Emblemas de Tipo (Elementos) */
        .type-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; }
        .type-badge { display: flex; align-items: center; justify-content: center; gap: 5px; padding: 10px; border-radius: 50px; cursor: pointer; font-weight: bold; color: white; opacity: 0.5; filter: grayscale(80%); transition: 0.3s; border: 3px solid transparent; font-size: 14px;}
        .type-badge:hover { opacity: 0.8; }
        input[type="checkbox"]:checked + .type-badge { opacity: 1; filter: grayscale(0%); transform: scale(1.05); border-color: #333; box-shadow: 0 4px 8px rgba(0,0,0,0.2); }
        
        /* Cores dos Tipos Oficiais */
        .bg-normal { background: #A8A878; } .bg-fire { background: #F08030; } .bg-water { background: #6890F0; }
        .bg-grass { background: #78C850; } .bg-electric { background: #F8D030; color: #333; } .bg-ice { background: #98D8D8; color: #333; }
        .bg-fighting { background: #C03028; } .bg-poison { background: #A040A0; } .bg-ground { background: #E0C068; color: #333; }
        .bg-flying { background: #A890F0; } .bg-psychic { background: #F85888; } .bg-bug { background: #A8B820; }
        .bg-rock { background: #B8A038; } .bg-ghost { background: #705898; } .bg-dragon { background: #7038F8; }
        .bg-dark { background: #705848; } .bg-steel { background: #B8B8D0; color: #333; } .bg-fairy { background: #EE99AC; color: #333; }

        /* Dynamic Inputs (Habilidades) */
        .dynamic-row { display: flex; gap: 10px; margin-bottom: 10px; }
        .btn-action { width: 46px; height: 46px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 22px; border: none; cursor: pointer; transition: 0.2s; font-weight: bold;}
        .btn-add { background: #2ecc71; color: white; }
        .btn-add:hover { background: #27ae60; }
        .btn-remove { background: #e74c3c; color: white; }
        .btn-remove:hover { background: #c0392b; }

        /* Switch Shiny */
        .shiny-toggle { display: inline-flex; align-items: center; gap: 10px; cursor: pointer; padding: 10px 20px; background: #eee; border-radius: 30px; font-weight: bold; transition: 0.3s; }
        input[type="checkbox"]:checked + .shiny-toggle { background: #f1c40f; color: #fff; box-shadow: 0 0 15px rgba(241, 196, 15, 0.5); }

        /* Sliders de Stats */
        .stat-row { display: flex; align-items: center; gap: 15px; margin-bottom: 10px; }
        .stat-label { width: 80px; font-weight: bold; font-size: 14px; }
        .stat-slider { flex: 1; }
        .stat-value { width: 40px; text-align: right; font-weight: bold; color: var(--pokedex-red); }

        /* Botoes Form */
        .btn-group { display: flex; justify-content: space-between; margin-top: 30px; }
        button { padding: 12px 25px; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; font-size: 16px; transition: 0.2s; }
        .btn-prev { background: #ccc; color: #333; }
        .btn-prev:hover { background: #bbb; }
        .btn-next, .btn-submit { background: var(--pokedex-red); color: white; }
        .btn-next:hover, .btn-submit:hover { background: #c02a0a; transform: translateY(-2px); }
    </style>
</head>
<body>

<div class="container">
    <h2>Nova Entrada Pokédex</h2>
    
    <div class="stepper">
        <div class="step active" id="indicator-1">1. Perfil</div>
        <div class="step" id="indicator-2">2. Físico</div>
        <div class="step" id="indicator-3">3. Batalha</div>
        <div class="step" id="indicator-4">4. Mídia</div>
    </div>

    @if ($errors->any())
    <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
        <strong style="display: block; margin-bottom: 10px;">Ops! Tivemos alguns problemas:</strong>
        <ul style="margin: 0; padding-left: 20px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form action="{{ route('pokemon.store') }}" method="POST" enctype="multipart/form-data" id="pokemonForm">
        @csrf

        <div class="form-step active" id="step-1">
            <div class="form-group">
                <label>Nome do Pokémon:</label>
                <input type="text" name="POKE_name" required placeholder="Ex: Charizard">
            </div>
            
            <div class="form-group">
                <label>Experiência Base (XP):</label>
                <input type="number" name="POKE_xp" required placeholder="Ex: 240">
            </div>

            <div class="form-group">
                <label>Selecione a Geração:</label>
                <div class="gen-grid">
                    <label><input type="radio" name="POKE_generation" value="Gen 1" class="hidden-input" required><div class="gen-card">Gen 1</div></label>
                    <label><input type="radio" name="POKE_generation" value="Gen 2" class="hidden-input"><div class="gen-card">Gen 2</div></label>
                    <label><input type="radio" name="POKE_generation" value="Gen 3" class="hidden-input"><div class="gen-card">Gen 3</div></label>
                    <label><input type="radio" name="POKE_generation" value="Gen 4" class="hidden-input"><div class="gen-card">Gen 4</div></label>
                    <label><input type="radio" name="POKE_generation" value="Gen 5" class="hidden-input"><div class="gen-card">Gen 5</div></label>
                    <label><input type="radio" name="POKE_generation" value="Gen 6" class="hidden-input"><div class="gen-card">Gen 6</div></label>
                    <label><input type="radio" name="POKE_generation" value="Gen 7" class="hidden-input"><div class="gen-card">Gen 7</div></label>
                    <label><input type="radio" name="POKE_generation" value="Gen 8" class="hidden-input"><div class="gen-card">Gen 8</div></label>
                    <label><input type="radio" name="POKE_generation" value="Gen 9" class="hidden-input"><div class="gen-card">Gen 9</div></label>
                </div>
            </div>

            <div class="btn-group">
                <div></div>
                <button type="button" class="btn-next" onclick="nextStep(1)">Próximo ➔</button>
            </div>
        </div>

        <div class="form-step" id="step-2">
            <div class="form-group">
                <label>Altura (metros):</label>
                <input type="number" step="0.1" name="POKE_height" required placeholder="Ex: 1.7">
            </div>
            <div class="form-group">
                <label>Peso (kg):</label>
                <input type="number" step="0.1" name="POKE_weight" required placeholder="Ex: 90.5">
            </div>
            <div class="form-group">
                <label>Versão Rara?</label>
                <label>
                    <input type="hidden" name="POKE_shiny" value="0">
                    <input type="checkbox" name="POKE_shiny" value="1" class="hidden-input">
                    <div class="shiny-toggle">✨ Marcar como Shiny</div>
                </label>
            </div>
            <div class="btn-group">
                <button type="button" class="btn-prev" onclick="prevStep(2)">🡄 Voltar</button>
                <button type="button" class="btn-next" onclick="nextStep(2)">Próximo ➔</button>
            </div>
        </div>

        <div class="form-step" id="step-3">
            <div class="form-group">
                <label>Tipos/Elementos (Escolha até 2):</label>
                <div class="type-grid">
                    <label><input type="checkbox" name="POKE_elements[]" value="Normal" class="hidden-input type-checkbox"><div class="type-badge bg-normal">⏺️ Normal</div></label>
                    <label><input type="checkbox" name="POKE_elements[]" value="Fire" class="hidden-input type-checkbox"><div class="type-badge bg-fire">🔥 Fogo</div></label>
                    <label><input type="checkbox" name="POKE_elements[]" value="Water" class="hidden-input type-checkbox"><div class="type-badge bg-water">💧 Água</div></label>
                    <label><input type="checkbox" name="POKE_elements[]" value="Grass" class="hidden-input type-checkbox"><div class="type-badge bg-grass">🌿 Planta</div></label>
                    <label><input type="checkbox" name="POKE_elements[]" value="Electric" class="hidden-input type-checkbox"><div class="type-badge bg-electric">⚡ Elétrico</div></label>
                    <label><input type="checkbox" name="POKE_elements[]" value="Ice" class="hidden-input type-checkbox"><div class="type-badge bg-ice">❄️ Gelo</div></label>
                    <label><input type="checkbox" name="POKE_elements[]" value="Fighting" class="hidden-input type-checkbox"><div class="type-badge bg-fighting">🥊 Lutador</div></label>
                    <label><input type="checkbox" name="POKE_elements[]" value="Poison" class="hidden-input type-checkbox"><div class="type-badge bg-poison">☠️ Veneno</div></label>
                    <label><input type="checkbox" name="POKE_elements[]" value="Ground" class="hidden-input type-checkbox"><div class="type-badge bg-ground">🪨 Terra</div></label>
                    <label><input type="checkbox" name="POKE_elements[]" value="Flying" class="hidden-input type-checkbox"><div class="type-badge bg-flying">🦅 Voador</div></label>
                    <label><input type="checkbox" name="POKE_elements[]" value="Psychic" class="hidden-input type-checkbox"><div class="type-badge bg-psychic">🧠 Psíquico</div></label>
                    <label><input type="checkbox" name="POKE_elements[]" value="Bug" class="hidden-input type-checkbox"><div class="type-badge bg-bug">🐛 Inseto</div></label>
                    <label><input type="checkbox" name="POKE_elements[]" value="Rock" class="hidden-input type-checkbox"><div class="type-badge bg-rock">🗿 Pedra</div></label>
                    <label><input type="checkbox" name="POKE_elements[]" value="Ghost" class="hidden-input type-checkbox"><div class="type-badge bg-ghost">👻 Fantasma</div></label>
                    <label><input type="checkbox" name="POKE_elements[]" value="Dragon" class="hidden-input type-checkbox"><div class="type-badge bg-dragon">🐉 Dragão</div></label>
                    <label><input type="checkbox" name="POKE_elements[]" value="Dark" class="hidden-input type-checkbox"><div class="type-badge bg-dark">🌑 Sombrio</div></label>
                    <label><input type="checkbox" name="POKE_elements[]" value="Steel" class="hidden-input type-checkbox"><div class="type-badge bg-steel">⚙️ Aço</div></label>
                    <label><input type="checkbox" name="POKE_elements[]" value="Fairy" class="hidden-input type-checkbox"><div class="type-badge bg-fairy">✨ Fada</div></label>
                </div>
            </div>
            
            <div class="form-group">
                <label>Habilidades:</label>
                <div id="abilities-container">
                    <div class="dynamic-row">
                        <input type="text" name="POKE_abilities[]" required placeholder="Ex: Blaze">
                        <button type="button" class="btn-action btn-add" onclick="addAbility()" title="Adicionar outra habilidade">+</button>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Status Base (Sliders):</label>
                <div class="stat-row">
                    <div class="stat-label">❤️ HP</div>
                    <input type="range" name="POKE_stats[hp]" min="1" max="255" value="50" class="stat-slider" oninput="updateStat('hp', this.value)">
                    <div class="stat-value" id="val-hp">50</div>
                </div>
                <div class="stat-row">
                    <div class="stat-label">⚔️ Ataque</div>
                    <input type="range" name="POKE_stats[attack]" min="1" max="255" value="50" class="stat-slider" oninput="updateStat('attack', this.value)">
                    <div class="stat-value" id="val-attack">50</div>
                </div>
                <div class="stat-row">
                    <div class="stat-label">🛡️ Defesa</div>
                    <input type="range" name="POKE_stats[defense]" min="1" max="255" value="50" class="stat-slider" oninput="updateStat('defense', this.value)">
                    <div class="stat-value" id="val-defense">50</div>
                </div>
                <div class="stat-row">
                    <div class="stat-label">💨 Velocid.</div>
                    <input type="range" name="POKE_stats[speed]" min="1" max="255" value="50" class="stat-slider" oninput="updateStat('speed', this.value)">
                    <div class="stat-value" id="val-speed">50</div>
                </div>
            </div>

            <div class="btn-group">
                <button type="button" class="btn-prev" onclick="prevStep(3)">🡄 Voltar</button>
                <button type="button" class="btn-next" onclick="nextStep(3)">Próximo ➔</button>
            </div>
        </div>

        <div class="form-step" id="step-4">
            <div class="form-group">
                <label>🖼️ Sprite (Imagem do Pokémon):</label>
                <input type="file" name="POKE_sprite" accept="image/*">
            </div>
            <div class="form-group">
                <label>🎵 Áudio (Grito/Som):</label>
                <input type="file" name="POKE_audio" accept="audio/*">
            </div>
            
            <div class="btn-group">
                <button type="button" class="btn-prev" onclick="prevStep(4)">🡄 Voltar</button>
                <button type="submit" class="btn-submit">💾 Salvar na Pokédex</button>
            </div>
        </div>

    </form>
</div>

<script>
    // Navegação do Stepper
    function nextStep(currentStep) {
        // Validação básica de HTML5 antes de prosseguir
        const currentForm = document.getElementById(`step-${currentStep}`);
        const inputs = currentForm.querySelectorAll('input[required]');
        let valid = true;
        
        inputs.forEach(input => {
            if (!input.checkValidity()) {
                input.reportValidity();
                valid = false;
            }
        });

        if(!valid) return;

        document.getElementById(`step-${currentStep}`).classList.remove('active');
        document.getElementById(`indicator-${currentStep}`).classList.remove('active');
        let next = currentStep + 1;
        document.getElementById(`step-${next}`).classList.add('active');
        document.getElementById(`indicator-${next}`).classList.add('active');
    }

    function prevStep(currentStep) {
        document.getElementById(`step-${currentStep}`).classList.remove('active');
        document.getElementById(`indicator-${currentStep}`).classList.remove('active');
        let prev = currentStep - 1;
        document.getElementById(`step-${prev}`).classList.add('active');
        document.getElementById(`indicator-${prev}`).classList.add('active');
    }

    // Atualizar visualização dos Sliders de Stats
    function updateStat(statName, value) {
        document.getElementById(`val-${statName}`).innerText = value;
    }

    // Adicionar/Remover Habilidades Dinamicamente
    function addAbility() {
        const container = document.getElementById('abilities-container');
        const newRow = document.createElement('div');
        newRow.className = 'dynamic-row';
        newRow.innerHTML = `
            <input type="text" name="POKE_abilities[]" required placeholder="Nova habilidade">
            <button type="button" class="btn-action btn-remove" onclick="this.parentElement.remove()" title="Remover habilidade">×</button>
        `;
        container.appendChild(newRow);
    }

    // Limitar seleção de tipos a no máximo 2
    const typeCheckboxes = document.querySelectorAll('.type-checkbox');
    typeCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const checkedBoxes = document.querySelectorAll('.type-checkbox:checked');
            if (checkedBoxes.length > 2) {
                this.checked = false; // Desmarca a atual
                alert('Um Pokémon pode ter no máximo 2 tipos!');
            }
        });
    });
</script>

</body>
</html>