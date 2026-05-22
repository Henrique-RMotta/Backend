<script lang="ts">
    import { apiFetch } from '$lib/api';
    import { onMount } from 'svelte';

    let autorizacoes = $state([]);
    let loading = $state(false);

    async function load() {
        try {
            const data = await apiFetch('/autorizacoes');
            // Filtramos apenas as que NÃO foram validadas ainda
            autorizacoes = data.filter((a: any) => !a.portaria || a.portaria.PORT_validate === 0 || a.portaria.PORT_validate === false);
        } catch (e) {
            console.error('Erro ao carregar autorizações:', e);
        }
    }

    onMount(() => {
        load();
        const interval = setInterval(load, 5000); // Atualiza a cada 5 segundos
        return () => clearInterval(interval);
    });

    async function validar(id: number) {
        try {
            await apiFetch(`/autorizacoes/${id}/validar`, 'POST');
            load();
        } catch (e) {
            alert('Erro ao validar');
        }
    }
</script>

<div class="bg-white p-6 rounded-lg shadow max-w-5xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Fila de Liberação (Portaria)</h2>
            <p class="text-sm text-gray-500 text-left">Alunos aguardando validação para entrada ou saída.</p>
        </div>
        <button onclick={load} class="bg-red-50 text-red-600 px-4 py-2 rounded-md text-sm font-semibold hover:bg-red-100 transition border border-red-100">
            🔄 Atualizar Fila
        </button>
    </div>

    {#if autorizacoes.length === 0}
        <div class="text-center py-20 bg-gray-50 rounded-lg border-2 border-dashed">
            <p class="text-gray-400 text-lg">Nenhum aluno aguardando liberação no momento.</p>
        </div>
    {:else}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            {#each autorizacoes as aut}
                <div class="p-4 border rounded-lg shadow-sm bg-white flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-start mb-2">
                            <span class="px-2 py-1 rounded text-[10px] font-bold uppercase {aut.AUT_type === 'saida' ? 'bg-orange-100 text-orange-700' : 'bg-red-100 text-red-700'}">
                                {aut.AUT_type === 'saida' ? 'Saída' : 'Entrada'}
                            </span>
                            <span class="text-[10px] text-gray-400">{new Date(aut.AUT_time).toLocaleString()}</span>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800">{aut.AUT_alunoname}</h3>
                        <p class="text-sm text-gray-600">Turma: <span class="font-semibold">{aut.AUT_alunoclass}</span></p>
                        <p class="text-xs text-gray-500 mt-1">Autorizado por: {aut.AUT_nameaqv}</p>
                        
                        {#if aut.AUT_signature_image}
                            <div class="mt-3 p-2 bg-gray-50 rounded border border-gray-100">
                                <p class="text-[9px] text-gray-400 uppercase mb-1">Assinatura AQV:</p>
                                <img src={aut.AUT_signature_image} alt="Assinatura" class="h-12 object-contain mix-blend-multiply" />
                            </div>
                        {/if}
                    </div>

                    <button 
                        onclick={() => validar(aut.id)}
                        class="mt-4 w-full bg-green-600 text-white py-2 rounded font-bold hover:bg-green-700 transition shadow-sm active:transform active:scale-95"
                    >
                        CONFIRMAR PASSAGEM
                    </button>
                </div>
            {/each}
        </div>
    {/if}

</div>
