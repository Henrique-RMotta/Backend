<script lang="ts">
    import { apiFetch } from '$lib/api';
    import { onMount } from 'svelte';

    let autorizacoes = $state([]);
    let loading = $state(false);

    async function load() {
        const data = await apiFetch('/autorizacoes');
        autorizacoes = data.filter((a: any) => !a.portaria?.PORT_validate);
    }

    onMount(load);

    async function validar(id: number) {
        try {
            await apiFetch(`/autorizacoes/${id}/validar`, 'POST');
            load();
        } catch (e) {
            alert('Erro ao validar');
        }
    }
</script>

<div class="bg-white p-6 rounded-lg shadow max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Fila de Liberação (Portaria)</h2>
        <button onclick={load} class="text-blue-600 text-sm hover:underline">Atualizar Lista</button>
    </div>

    {#if autorizacoes.length === 0}
        <p class="text-center text-gray-500 py-10">Nenhum aluno aguardando liberação no momento.</p>
    {:else}
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b bg-gray-50 text-xs uppercase text-gray-600">
                        <th class="p-3">Aluno</th>
                        <th class="p-3">Turma</th>
                        <th class="p-3">Tipo</th>
                        <th class="p-3">AQV Responsável</th>
                        <th class="p-3">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    {#each autorizacoes as aut}
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3 font-medium">{aut.AUT_alunoname}</td>
                            <td class="p-3">{aut.AUT_alunoclass}</td>
                            <td class="p-3">
                                <span class="px-2 py-1 rounded text-xs {aut.AUT_type === 'saida' ? 'bg-orange-100 text-orange-700' : 'bg-blue-100 text-blue-700'}">
                                    {aut.AUT_type.toUpperCase()}
                                </span>
                            </td>
                            <td class="p-3 text-sm text-gray-600">{aut.AUT_nameaqv}</td>
                            <td class="p-3">
                                <button 
                                    onclick={() => validar(aut.id)}
                                    class="bg-green-600 text-white px-4 py-1 rounded text-sm hover:bg-green-700 transition"
                                >
                                    Validar Entrada/Saída
                                </button>
                            </td>
                        </tr>
                    {/each}
                </tbody>
            </table>
        </div>
    {/if}
    
    <div class="mt-8 p-4 bg-blue-50 border border-blue-200 rounded text-sm text-blue-800">
        <strong>Dica de Segurança:</strong> Ao validar, uma notificação automática (WhatsApp/E-mail) é disparada para o responsável através do sistema.
    </div>
</div>
