<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clientes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-md text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <p class="text-sm text-gray-600">Total: <span class="font-semibold text-gray-800">{{ $clientes->count() }}</span> clientes</p>
                    <div class="flex items-center gap-3">
                        <input type="text" id="searchInput" onkeyup="filtrarTabela()" placeholder="Buscar..."
                            class="px-3 py-1.5 text-sm border border-gray-300 rounded-md text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400">
                        <a href="{{ route('clientes.create') }}"
                           class="px-4 py-2 bg-gray-800 text-white text-sm font-semibold rounded-md hover:bg-gray-700 active:bg-gray-900 transition ease-in-out duration-150">
                            + Novo Cliente
                        </a>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full divide-y divide-gray-200" id="tabelaClientes">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CPF</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telefone</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($clientes as $cliente)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-400">{{ $cliente->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $cliente->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $cliente->cpf }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $cliente->telefone }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $cliente->email }}</td>
                                   <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        <div class="flex items-center gap-3">
                                            <a href="{{ route('clientes.edit', $cliente->id) }}"
                                            class="text-xs font-medium text-gray-600 hover:text-gray-900 transition-colors duration-150">
                                                Editar
                                            </a>
                                            <span class="text-gray-300">|</span>
                                            <button onclick="abrirModal('{{ route('clientes.destroy', $cliente->id) }}', 'Deseja excluir o cliente {{ $cliente->name }}?')"
                                                    class="text-xs font-medium text-red-500 hover:text-red-700 transition-colors duration-150">
                                                Excluir
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-sm text-gray-400">
                                        Nenhum cliente encontrado.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <div id="modalConfirm" class="fixed inset-0 z-50 hidden items-center justify-center">

    {{-- Fundo escurecido --}}
    <div class="absolute inset-0 bg-gray-900/50" onclick="fecharModal()"></div>

    {{-- Modal --}}
    <div class="relative bg-white rounded-xl shadow-lg w-full max-w-sm mx-4 p-6 z-10">
        <div class="flex items-start gap-4">
            <div class="flex-shrink-0 flex items-center justify-center w-10 h-10 rounded-full bg-red-100">
                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                </svg>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-gray-900">Confirmar exclusão</h3>
                <p id="modalMensagem" class="mt-1 text-sm text-gray-500">Tem certeza que deseja excluir este item?</p>
            </div>
        </div>

        <div class="mt-6 flex justify-end gap-3">
            <button onclick="fecharModal()"
                class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors duration-150">
                Cancelar
            </button>
            <form id="modalForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-md hover:bg-red-700 active:bg-red-800 transition ease-in-out duration-150">
                    Excluir
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function abrirModal(action, mensagem) {
        document.getElementById('modalForm').action = action;
        document.getElementById('modalMensagem').innerText = mensagem;
        const modal = document.getElementById('modalConfirm');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function fecharModal() {
        const modal = document.getElementById('modalConfirm');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
    <script>
        function filtrarTabela() {
            const input = document.getElementById('searchInput').value.toLowerCase();
            document.querySelectorAll('#tabelaClientes tbody tr').forEach(row => {
                row.style.display = row.innerText.toLowerCase().includes(input) ? '' : 'none';
            });
        }
    </script>

</x-app-layout>