<script lang="ts">
    import { apiFetch } from '$lib/api';
    import { onMount } from 'svelte';

    let autorizacoes = $state([]);
    let historico = $state([]);
    let loading = $state(false);

    async function load() {
        try {
            const data = await apiFetch('/autorizacoes');
            // Alunos aguardando validação
            autorizacoes = data.filter((a: any) => !a.portaria || a.portaria.PORT_validate === 0 || a.portaria.PORT_validate === false);
            // Alunos que já entraram ou saíram
            historico = data.filter((a: any) => a.portaria && (a.portaria.PORT_validate === 1 || a.portaria.PORT_validate === true));
        } catch (e) {
            console.error('Erro ao carregar autorizações:', e);
        }
    }

    onMount(() => {
        load();
        const interval = setInterval(load, 5000); 
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

<div class="max-w-6xl mx-auto space-y-8">
    <!-- FILA DE LIBERAÇÃO -->
    <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-red-600">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Fila de Liberação (Portaria)</h2>
                <p class="text-sm text-gray-500">Alunos com pré-autorização aguardando passagem.</p>
            </div>
            <button onclick={load} class="bg-red-50 text-red-600 px-4 py-2 rounded-md text-sm font-semibold hover:bg-red-100 transition border border-red-100">
                🔄 Atualizar Fila
            </button>
        </div>

        {#if autorizacoes.length === 0}
            <div class="text-center py-10 bg-gray-50 rounded-lg border-2 border-dashed">
                <p class="text-gray-400">Nenhum aluno aguardando liberação.</p>
            </div>
        {:else}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                {#each autorizacoes as aut}
                    <div class="p-4 border rounded-lg shadow-sm bg-white flex flex-col justify-between border-l-4 border-yellow-400">
                        <div>
                            <div class="flex justify-between items-start mb-2">
                                <span class="px-2 py-1 rounded text-[10px] font-bold uppercase {aut.AUT_type === 'saida' ? 'bg-orange-100 text-orange-700' : 'bg-red-100 text-red-700'}">
                                    {aut.AUT_type === 'saida' ? 'Saída' : 'Entrada'}
                                </span>
                                <span class="text-[10px] text-gray-400">{new Date(aut.AUT_time).toLocaleTimeString([], {hour: '2-2-digit', minute:'2-2-digit'})}</span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">{aut.AUT_alunoname}</h3>
                            <p class="text-sm text-gray-600">Turma: <span class="font-semibold">{aut.AUT_alunoclass}</span></p>
                            
                            {#if aut.AUT_signature_image}
                                <div class="mt-2 p-2 bg-yellow-50 rounded border border-yellow-100">
                                    <p class="text-[9px] text-yellow-700 uppercase font-bold">Assinado por AQV:</p>
                                    <p class="text-sm font-serif italic text-gray-800">{aut.AUT_signature_image}</p>
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

    <!-- HISTÓRICO DE MOVIMENTAÇÕES -->
    <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-gray-400">
        <h2 class="text-xl font-bold text-gray-800 mb-4 text-left">Histórico de Movimentações (Hoje)</h2>
        
        {#if historico.length === 0}
            <p class="text-gray-400 text-sm italic">Nenhuma movimentação registrada hoje.</p>
        {:else}
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="bg-gray-50 border-b">
                            <th class="p-3">Horário</th>
                            <th class="p-3">Aluno</th>
                            <th class="p-3">Turma</th>
                            <th class="p-3">Fluxo</th>
                            <th class="p-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        {#each historico as h}
                            <tr class="border-b hover:bg-gray-50 transition">
                                <td class="p-3 text-gray-500">{new Date(h.updated_at).toLocaleTimeString()}</td>
                                <td class="p-3 font-semibold text-gray-700">{h.AUT_alunoname}</td>
                                <td class="p-3 text-gray-600">{h.AUT_alunoclass}</td>
                                <td class="p-3">
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase {h.AUT_type === 'saida' ? 'bg-orange-50 text-orange-600' : 'bg-red-50 text-red-600'}">
                                        {h.AUT_type}
                                    </span>
                                </td>
                                <td class="p-3">
                                    <span class="flex items-center text-green-600 font-bold text-xs">
                                        <span class="mr-1">✔</span> REALIZADO
                                    </span>
                                </td>
                            </tr>
                        {/each}
                    </tbody>
                </table>
            </div>
        {/if}
    </div>
</div>
