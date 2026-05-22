<script lang="ts">
    import { auth } from '$lib/auth.svelte';
    import { onMount } from 'svelte';
    import './layout.css';

    let { children } = $props();
</script>

<div class="min-h-screen bg-gray-50 font-sans">
    {#if auth.user}
        <nav class="bg-red-600 text-white p-4 shadow-md flex justify-between items-center">
            <h1 class="text-xl font-bold">SAFE - Sistema de Autorização</h1>
            <div class="flex items-center gap-4">
                <span>Olá, {auth.user.name} ({auth.user.role.toUpperCase()})</span>
                <button 
                    onclick={() => auth.logout()} 
                    class="bg-gray-800 hover:bg-black px-3 py-1 rounded text-sm transition"
                >
                    Sair
                </button>
            </div>
        </nav>
    {/if}

    <main class="p-6">
        {@render children()}
    </main>
</div>
