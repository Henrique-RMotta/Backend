<script lang="ts">
    import { apiFetch } from '$lib/api';
    import { auth } from '$lib/auth.svelte';
    import { onMount } from 'svelte';

    let alunoname = $state('');
    let alunoclass = $state('');
    let type = $state('saida');
    let loading = $state(false);
    let success = $state(false);
    let autorizacoes = $state([]);

    async function loadAutorizacoes() {
        autorizacoes = await apiFetch('/autorizacoes');
    }

    onMount(loadAutorizacoes);

    async function handleSubmit() {
        loading = true;
        try {
            await apiFetch('/autorizacoes', 'POST', {
                AUT_alunoname: alunoname,
                AUT_alunoclass: alunoclass,
                AUT_type: type,
                AUT_nameaqv: auth.user.name,
                AUT_signature_image: 'assinatura_digital_v01'
            });
            success = true;
            alunoname = '';
            alunoclass = '';
            loadAutorizacoes();
            setTimeout(() => success = false, 3000);
        } catch (e) {
            alert('Erro ao criar autorização');
        } finally {
            loading = false;
        }
    }
</script>

<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <!-- Formulário -->
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-xl font-bold mb-4">Nova Pré-Autorização</h2>
        
        {#if success}
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">Autorização criada com sucesso!</div>
        {/if}

        <form onsubmit={(e) => { e.preventDefault(); handleSubmit(); }} class="space-y-4">
            <div>
                <label for="alunoname" class="block text-sm font-medium">Nome do Aluno</label>
                <input id="alunoname" bind:value={alunoname} required class="w-full p-2 border rounded" />
            </div>
            <div>
                <label for="alunoclass" class="block text-sm font-medium">Turma</label>
                <input id="alunoclass" bind:value={alunoclass} required class="w-full p-2 border rounded" />
            </div>
            <div>
                <label for="type" class="block text-sm font-medium">Tipo de Fluxo</label>
                <select id="type" bind:value={type} class="w-full p-2 border rounded">
                    <option value="saida">Saída Antecipada</option>
                    <option value="entrada">Entrada Tardia</option>
                </select>
            </div>
            <button type="submit" disabled={loading}
                class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                {loading ? 'Salvando...' : 'Registrar Autorização'}
            </button>
        </form>
    </div>

    <!-- Lista Recente -->
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-xl font-bold mb-4">Pedidos Recentes</h2>
        <div class="space-y-3">
            {#each autorizacoes.slice(0, 5) as aut}
                <div class="p-3 border-l-4 {aut.portaria?.PORT_validate ? 'border-green-500' : 'border-yellow-500'} bg-gray-50 rounded shadow-sm">
                    <p class="font-bold">{aut.AUT_alunoname} - {aut.AUT_alunoclass}</p>
                    <p class="text-sm text-gray-600">{aut.AUT_type.toUpperCase()} | AQV: {aut.AUT_nameaqv}</p>
                    <span class="text-xs {aut.portaria?.PORT_validate ? 'text-green-600' : 'text-yellow-600'}">
                        {aut.portaria?.PORT_validate ? '✅ Validado na Portaria' : '⏳ Pendente'}
                    </span>
                </div>
            {/each}
        </div>
    </div>
</div>
