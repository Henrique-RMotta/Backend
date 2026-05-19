<script lang="ts">
	// Central / Hub de controle do SAFE
</script>

<div class="max-w-5xl mx-auto space-y-8">
	<div class="bg-gradient-to-r from-slate-900 to-slate-800 text-white rounded-3xl p-8 shadow-sm relative overflow-hidden">
		<div class="absolute -right-10 -bottom-10 w-40 h-40 bg-red-600/10 rounded-full blur-2xl"></div>
		<div class="relative z-10 max-w-2xl space-y-2">
			<span class="bg-red-600 text-white text-xs font-bold uppercase tracking-widest px-3 py-1 rounded-full">Portal Integrado</span>
			<h2 class="text-3xl font-black tracking-tight md:text-4xl">Painel de Monitoramento SAFE</h2>
			<p class="text-slate-300 text-sm md:text-base leading-relaxed">
				Gerencie a emissão de autorizações e valide o fluxo de acessos físicos em tempo real. Cada evento na portaria aciona notificações automáticas via Mailpit/Log.
			</p>
		</div>
	</div>

	<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
		<div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-xs hover:shadow-md transition-all flex flex-col justify-between gap-6">
			<div class="space-y-3">
				<div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center">
					<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
				</div>
				<h3 class="text-xl font-bold text-gray-800">Módulo Docente</h3>
				<p class="text-sm text-gray-500 leading-relaxed">
					Visualize a listagem de turmas escolares, gerencie diários de presença ativa e assine **pré-autorizações digitais** de liberação imediata.
				</p>
			</div>
			<a href="/chamada/3DEVT" class="w-full h-11 bg-slate-900 hover:bg-slate-800 text-white font-semibold rounded-xl flex items-center justify-center transition-colors text-sm shadow-xs">
				Abrir Diários de Chamada
			</a>
		</div>

		<div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-xs hover:shadow-md transition-all flex flex-col justify-between gap-6">
			<div class="space-y-3">
				<div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center">
					<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
				</div>
				<h3 class="text-xl font-bold text-gray-800">Módulo Portaria / Guarita</h3>
				<p class="text-sm text-gray-500 leading-relaxed">
					Valide a movimentação dos estudantes. O sistema confere as credenciais geradas pelos professores e dispara a segurança integrada.
				</p>
			</div>
			<a href="/portaria" class="w-full h-11 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-xl flex items-center justify-center transition-colors text-sm shadow-xs">
				Acessar Validador de Fluxo
			</a>
		</div>
	</div>

	<div class="bg-gray-100 rounded-2xl p-5 border border-gray-200/60 text-xs text-gray-500 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
		<div class="flex items-center gap-2">
			<span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
			<span class="font-medium text-gray-600">Comunicação ativa com a API Laravel (Portarias & Autorizações)</span>
		</div>
		<div class="font-mono text-gray-400">
			Svelte 5 + Tailwind v4 CSS Stack
		</div>
	</div>
</div>