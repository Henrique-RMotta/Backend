<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Novo Pedido') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="px-6 py-4 border-b border-gray-200">
                    <p class="text-sm text-gray-600">Preencha os dados do novo Pedido.</p>
                </div>

                <form action="{{ route('pedido.store') }}" method="POST" class="px-6 py-6 space-y-5">
                    @csrf

                    {{-- Nome --}}
                    <div>
                        <label for="nome" class="block text-sm font-medium text-gray-700 mb-1">Nome <span class="text-red-500">*</span></label>
                        <input type="text" id="nome" name="nome" value="{{ old('nome') }}"
                            class="w-full px-3 py-2 text-sm border @error('nome') border-red-400 @else border-gray-300 @enderror rounded-md text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400">
                        @error('nome')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Produto --}}
                    <div>
                        <label for="produto" class="block text-sm font-medium text-gray-700 mb-1">Produto<span class="text-red-500">*</span></label>
                        <input type="text" id="produto" name="produto" value="{{ old('produto') }}"
                            class="w-full px-3 py-2 text-sm border @error('cpf') border-red-400 @else border-gray-300 @enderror rounded-md text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400">
                        @error('produto')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Fornecedor --}}
                    <div>
                        <label for="fornecedor" class="block text-sm font-medium text-gray-700 mb-1">Fornecedor<span class="text-red-500">*</span></label>
                        <input type="fornecedor" id="fornecedor" name="fornecedor" value="{{ old('fornecedor') }}"
                            class="w-full px-3 py-2 text-sm border @error('fornecedor') border-red-400 @else border-gray-300 @enderror rounded-md text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400">
                        @error('fornecedor')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Botões --}}
                    <div class="flex items-center justify-end gap-3 pt-2 border-t border-gray-100">
                        <a href="{{ route('pedido.index') }}"
                           class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors duration-150">
                            Cancelar
                        </a>
                        <button type="submit"
                                class="px-4 py-2 bg-gray-800 text-white text-sm font-semibold rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-300 transition ease-in-out duration-150">
                            Salvar Pedido
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>