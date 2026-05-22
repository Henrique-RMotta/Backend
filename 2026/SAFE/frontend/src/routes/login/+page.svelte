<script lang="ts">
    import { auth } from '$lib/auth.svelte';
    import { apiFetch } from '$lib/api';
    import { goto } from '$app/navigation';

    let email = $state('aqv@safe.com');
    let password = $state('password');
    let error = $state('');
    let loading = $state(false);

    async function handleLogin() {
        loading = true;
        error = '';
        try {
            const data = await apiFetch('/login', 'POST', { email, password });
            auth.login(data.user);
            
            if (data.user.role === 'aqv') goto('/aqv');
            else if (data.user.role === 'portaria') goto('/portaria');
            else goto('/dashboard');
        } catch (e: any) {
            error = e.message;
        } finally {
            loading = false;
        }
    }
</script>

<div class="max-w-md mx-auto mt-20 p-8 bg-white rounded-xl shadow-lg">
    <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">Login SAFE</h2>
    
    {#if error}
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">{error}</div>
    {/if}

    <form onsubmit={(e) => { e.preventDefault(); handleLogin(); }} class="space-y-4">
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
            <input id="email" type="email" bind:value={email} required
                class="w-full mt-1 p-2 border rounded focus:ring-2 focus:ring-red-500 outline-none" />
        </div>
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
            <input id="password" type="password" bind:value={password} required
                class="w-full mt-1 p-2 border rounded focus:ring-2 focus:ring-red-500 outline-none" />
        </div>
        <button type="submit" disabled={loading}
            class="w-full bg-red-600 text-white py-2 rounded font-semibold hover:bg-red-700 transition disabled:opacity-50">
            {loading ? 'Entrando...' : 'Acessar Sistema'}
        </button>
    </form>
    
    <div class="mt-6 text-xs text-gray-500 text-center">
        <p>Usuários de teste:</p>
        <p>aqv@safe.com | portaria@safe.com (senha: password)</p>
    </div>
</div>
