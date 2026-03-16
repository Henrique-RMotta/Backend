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
                                            <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST"
                                                  onsubmit="return confirm('Deseja excluir este cliente?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-xs font-medium text-red-500 hover:text-red-700 transition-colors duration-150">
                                                    Excluir
                                                </button>
                                            </form>
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

    <script>
        function filtrarTabela() {
            const input = document.getElementById('searchInput').value.toLowerCase();
            document.querySelectorAll('#tabelaClientes tbody tr').forEach(row => {
                row.style.display = row.innerText.toLowerCase().includes(input) ? '' : 'none';
            });
        }
    </script>

</x-app-layout>