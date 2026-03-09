<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Novo Fornecedor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="px-6 py-4 border-b border-gray-200">
                    <p class="text-sm text-gray-600">Preencha os dados do novo Fornecedor.</p>
                </div>

                <form action="{{ route('fornecedor.store') }}" method="POST" class="px-6 py-6 space-y-5">
                    @csrf

                    {{-- Nome --}}
                    <div>
                        <label for="FOR_nome" class="block text-sm font-medium text-gray-700 mb-1">Nome <span class="text-red-500">*</span></label>
                        <input type="text" id="FOR_nome" name="FOR_nome" value="{{ old('FOR_nome') }}"
                            class="w-full px-3 py-2 text-sm border @error('FOR_nome') border-red-400 @else border-gray-300 @enderror rounded-md text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400">
                        @error('FOR_nome')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- cpf --}}
                    <div>
                        <label for="FOR_cpf" class="block text-sm font-medium text-gray-700 mb-1">cpf<span class="text-red-500">*</span></label>
                        <input type="number" id="FOR_cpf" name="FOR_cpf" value="{{ old('FOR_cpf') }}"
                            class="w-full px-3 py-2 text-sm border @error('cpf') border-red-400 @else border-gray-300 @enderror rounded-md text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400">
                        @error('FOR_cpf')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- telefone --}}
                    <div>
                        <label for="FOR_telefone" class="block text-sm font-medium text-gray-700 mb-1">telefone<span class="text-red-500">*</span></label>
                        <input type="number" id="FOR_telefone" name="FOR_telefone" value="{{ old('FOR_telefone') }}"
                            class="w-full px-3 py-2 text-sm border @error('FOR_telefone') border-red-400 @else border-gray-300 @enderror rounded-md text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400">
                        @error('FOR_telefone')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- endereco --}}
                    <div>
                        <label for="FOR_endereco" class="block text-sm font-medium text-gray-700 mb-1">endereco<span class="text-red-500">*</span></label>
                        <input type="text" id="FOR_endereco" name="FOR_endereco" value="{{ old('FOR_endereco') }}"
                            class="w-full px-3 py-2 text-sm border @error('FOR_endereco') border-red-400 @else border-gray-300 @enderror rounded-md text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400">
                        @error('FOR_endereco')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Botões --}}
                    <div class="flex items-center justify-end gap-3 pt-2 border-t border-gray-100">
                        <a href="{{ route('fornecedor.index') }}"
                           class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors duration-150">
                            Cancelar
                        </a>
                        <button type="submit"
                                class="px-4 py-2 bg-gray-800 text-white text-sm font-semibold rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-300 transition ease-in-out duration-150">
                            Salvar Fornecedor
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>