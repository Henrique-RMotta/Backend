<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Estoque') }}
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
                    <p class="text-sm text-gray-600">Total: <span
                            class="font-semibold text-gray-800">{{ $estoque->count() }}</span> item</p>
                    <input type="text" id="searchInput" onkeyup="filtrarTabela()" placeholder="Buscar..."
                        class="px-3 py-1.5 text-sm border border-gray-300 rounded-md text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400">
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full w-full table-fixed divide-y divide-gray-200" id="tabelaEstoque">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-16">
                                    #</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nome</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-40">
                                    Quantidade</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-48">
                                    Criado em</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($estoque as $item)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-400 align-middle">
                                        {{ $item->id }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900 align-middle">
                                        {{ $item->ES_nome }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600 align-middle">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $item->ES_quantidade > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">
                                            {{ $item->ES_quantidade }} un.
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500 align-middle">
                                        {{ $item->created_at->format('d/m/Y') }}
                                        <span
                                            class="text-gray-400 text-xs ml-1">{{ $item->created_at->format('H:i') }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-sm text-gray-400">
                                        Nenhum item no estoque.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                   </div>
                     <div class="px-4 py-2 bg-gray-800 text-white text-sm font-semibold rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-300 transition ease-in-out duration-150">
                    <x-nav-link :href="route('estoque.create')" :active="request()->routeIs('estoque')">
                        {{ __('Adicionar novo item') }}
                    </x-nav-link>
                </div>
            </div>
        </div>
    </div>

    <script>
        function filtrarTabela() {
            const input = document.getElementById('searchInput').value.toLowerCase();
            document.querySelectorAll('#tabelaEstoque tbody tr').forEach(row => {
                row.style.display = row.innerText.toLowerCase().includes(input) ? '' : 'none';
            });
        }
    </script>

</x-app-layout>