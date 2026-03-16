<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Produto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="px-6 py-4 border-b border-gray-200">
                    <p class="text-sm text-gray-600">Edite os dados do produto.</p>
                </div>

                <form action="{{ route('produto.update', $produto->id) }}" method="POST" class="px-6 py-6 space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="PR_nome" class="block text-sm font-medium text-gray-700 mb-1">Nome <span class="text-red-500">*</span></label>
                        <input type="text" id="PR_nome" name="PR_nome" value="{{ old('PR_nome', $produto->PR_nome) }}"
                            class="w-full px-3 py-2 text-sm border @error('PR_nome') border-red-400 @else border-gray-300 @enderror rounded-md text-gray-900 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400">
                        @error('PR_nome') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="PR_descricao" class="block text-sm font-medium text-gray-700 mb-1">Descrição <span class="text-red-500">*</span></label>
                        <textarea id="PR_descricao" name="PR_descricao" rows="3"
                            class="w-full px-3 py-2 text-sm border @error('PR_descricao') border-red-400 @else border-gray-300 @enderror rounded-md text-gray-900 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400">{{ old('PR_descricao', $produto->PR_descricao) }}</textarea>
                        @error('PR_descricao') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="PR_preco" class="block text-sm font-medium text-gray-700 mb-1">Preço <span class="text-red-500">*</span></label>
                        <input type="number" step="0.01" id="PR_preco" name="PR_preco" value="{{ old('PR_preco', $produto->PR_preco) }}"
                            class="w-full px-3 py-2 text-sm border @error('PR_preco') border-red-400 @else border-gray-300 @enderror rounded-md text-gray-900 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400">
                        @error('PR_preco') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-2 border-t border-gray-100">
                        <a href="{{ route('produto.index') }}" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors duration-150">
                            Cancelar
                        </a>
                        <button type="submit" class="px-4 py-2 bg-gray-800 text-white text-sm font-semibold rounded-md hover:bg-gray-700 active:bg-gray-900 transition ease-in-out duration-150">
                            Atualizar Produto
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>