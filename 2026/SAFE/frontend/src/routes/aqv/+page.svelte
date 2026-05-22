<script lang="ts">
    import { apiFetch } from '$lib/api';
    import { auth } from '$lib/auth.svelte';
    import { onMount } from 'svelte';

    let alunoname = $state('');
    let alunoclass = $state('');
    let type = $state('saida');
    let teacher_email = $state('');
    let aut_time = $state(new Date().toISOString().slice(0, 16));
    let signature = $state('');
    let fouls = $state({
        falta1: false,
        falta2: false,
        falta3: false,
        falta4: false,
        falta5: false
    });
    
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
                AUT_teacher_email: teacher_email,
                AUT_time: aut_time,
                AUT_signature_image: signature || 'assinatura_digital_v01',
                AUT_fouls: fouls,
                AUT_nameaqv: auth.user.name
            });
            success = true;
            alunoname = '';
            alunoclass = '';
            teacher_email = '';
            signature = '';
            loadAutorizacoes();
            setTimeout(() => success = false, 3000);
        } catch (e) {
            alert('Erro ao criar autorização');
        } finally {
            loading = false;
        }
    }
</script>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Formulário -->
    <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow">
        <h2 class="text-xl font-bold mb-4 text-blue-800 border-b pb-2">Nova Pré-Autorização</h2>
        
        {#if success}
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4 shadow-sm border border-green-200">
                ✅ Autorização registrada e enviada para portaria!
            </div>
        {/if}

        <form onsubmit={(e) => { e.preventDefault(); handleSubmit(); }} class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="alunoname" class="block text-sm font-medium text-gray-700">Nome do Aluno</label>
                    <input id="alunoname" bind:value={alunoname} required class="w-full mt-1 p-2 border rounded focus:ring-2 focus:ring-blue-500 outline-none" />
                </div>
                <div>
                    <label for="alunoclass" class="block text-sm font-medium text-gray-700">Turma</label>
                    <input id="alunoclass" bind:value={alunoclass} required class="w-full mt-1 p-2 border rounded focus:ring-2 focus:ring-blue-500 outline-none" />
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Tipo de Fluxo</label>
                    <select id="type" bind:value={type} class="w-full mt-1 p-2 border rounded focus:ring-2 focus:ring-blue-500 outline-none">
                        <option value="saida">Saída Antecipada</option>
                        <option value="entrada">Entrada Tardia</option>
                    </select>
                </div>
                <div>
                    <label for="aut_time" class="block text-sm font-medium text-gray-700">Horário Previsto</label>
                    <input id="aut_time" type="datetime-local" bind:value={aut_time} required class="w-full mt-1 p-2 border rounded focus:ring-2 focus:ring-blue-500 outline-none" />
                </div>
            </div>

            <div>
                <label for="teacher_email" class="block text-sm font-medium text-gray-700">E-mail do Professor (Sala)</label>
                <input id="teacher_email" type="email" bind:value={teacher_email} placeholder="professor@escola.com" class="w-full mt-1 p-2 border rounded focus:ring-2 focus:ring-blue-500 outline-none" />
            </div>

            <div class="bg-gray-50 p-4 rounded-md border">
                <p class="text-sm font-semibold mb-3 text-gray-800">Checklist de Faltas / Pendências:</p>
                <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                    {#each Object.keys(fouls) as foul}
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" bind:checked={fouls[foul]} class="rounded text-blue-600 focus:ring-blue-500" />
                            <span class="text-sm text-gray-600">{foul.replace('falta', 'Aula ')}</span>
                        </label>
                    {/each}
                </div>
            </div>

            <div>
                <label for="signature" class="block text-sm font-medium text-gray-700">Assinatura Digital (AQV)</label>
                <textarea id="signature" bind:value={signature} placeholder="Assine aqui (Texto ou Base64)" rows="2" class="w-full mt-1 p-2 border rounded bg-yellow-50 font-serif italic focus:ring-2 focus:ring-blue-500 outline-none"></textarea>
            </div>

            <button type="submit" disabled={loading}
                class="w-full bg-blue-600 text-white py-3 rounded-lg font-bold hover:bg-blue-700 transition shadow-md disabled:opacity-50">
                {loading ? 'Processando...' : 'FINALIZAR E ENVIAR PARA PORTARIA'}
            </button>
        </form>
    </div>

    <!-- Lista Recente -->
    <div class="bg-white p-6 rounded-lg shadow h-fit">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Pedidos Recentes</h2>
        <div class="space-y-4">
            {#if autorizacoes.length === 0}
                <p class="text-sm text-gray-500">Nenhuma autorização hoje.</p>
            {/if}
            {#each autorizacoes.slice(0, 8) as aut}
                <div class="p-3 border-l-4 {aut.portaria?.PORT_validate ? 'border-green-500' : 'border-yellow-500'} bg-gray-50 rounded shadow-sm relative overflow-hidden">
                    <p class="font-bold text-gray-800">{aut.AUT_alunoname}</p>
                    <p class="text-xs text-gray-600 uppercase tracking-wider">{aut.AUT_alunoclass} | {aut.AUT_type}</p>
                    <p class="text-[10px] text-gray-400 mt-1">{new Date(aut.AUT_time).toLocaleString()}</p>
                    
                    <div class="mt-2 flex justify-between items-center">
                        <span class="text-[10px] font-semibold {aut.portaria?.PORT_validate ? 'text-green-600' : 'text-yellow-600'}">
                            {aut.portaria?.PORT_validate ? 'CONCLUÍDO' : 'AGUARDANDO PORTARIA'}
                        </span>
                    </div>
                </div>
            {/each}
        </div>
    </div>
</div>
