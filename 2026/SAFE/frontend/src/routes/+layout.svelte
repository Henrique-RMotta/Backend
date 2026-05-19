<script lang="ts">
	import './layout.css';
	import favicon from '$lib/assets/favicon.svg';

	// Svelte 5 Runes para capturar os nós filhos e gerenciar estados reativos
	let { children } = $props();
	let sidebarAberta = $state(true);
</script>

<svelte:head>
	<link rel="icon" href={favicon} />
	<title>SAFE - Sistema de Autorização e Fluxo Escolar</title>
</svelte:head>

<div class="min-h-screen flex bg-gray-50 text-gray-900 font-sans">
	
	<aside class="bg-slate-900 text-white w-64 flex-shrink-0 transition-all duration-300 flex flex-col border-r border-slate-800 
		{sidebarAberta ? 'translate-x-0' : '-translate-x-64 md:w-0 md:opacity-0 overflow-hidden'}">
		
		<div class="p-6 border-b border-slate-800 flex items-center gap-3">
			<div class="w-8 h-8 bg-red-600 rounded-lg flex items-center justify-center font-black text-lg text-white">S</div>
			<div>
				<h1 class="font-bold text-base leading-none text-white tracking-wide">SAFE</h1>
				<span class="text-xs text-slate-400 font-medium">Fluxo & Segurança</span>
			</div>
		</div>

		<nav class="flex-1 p-4 space-y-1.5">
			<a href="/" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition-colors text-sm font-medium text-slate-300 hover:text-white">
				<svg class="w-5 h-5 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
				Início / Dashboard
			</a>
			
			<a href="/chamada/3DEVT" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition-colors text-sm font-medium text-slate-300 hover:text-white">
				<svg class="w-5 h-5 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
				Módulo do Professor
			</a>
			
			<a href="/portaria" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition-colors text-sm font-medium text-slate-300 hover:text-white">
				<svg class="w-5 h-5 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
				Controle de Portaria
			</a>
		</nav>

		<div class="p-4 border-t border-slate-800 text-xs text-slate-500 text-center font-mono">
			SENAI Limeira &copy; 2026
		</div>
	</aside>

	<div class="flex-1 flex flex-col min-w-0 overflow-hidden">
		
		<header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-6 z-10 flex-shrink-0">
			<button onclick={() => sidebarAberta = !sidebarAberta} class="p-2 hover:bg-gray-100 rounded-xl transition-colors text-gray-500 cursor-pointer">
				<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
			</button>

			<div class="flex items-center gap-4">
				<div class="text-right hidden sm:block">
					<p class="text-sm font-bold text-gray-700">Operador Integrado</p>
					<p class="text-xs text-emerald-600 font-semibold flex items-center gap-1 justify-end">
						<span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span> Online
					</p>
				</div>
				<div class="w-10 h-10 rounded-xl bg-slate-100 border border-gray-200 flex items-center justify-center font-bold text-slate-700">
					OP
				</div>
			</div>
		</header>

		<main class="flex-1 overflow-y-auto p-8">
			{@render children()}
		</main>
	</div>
</div>