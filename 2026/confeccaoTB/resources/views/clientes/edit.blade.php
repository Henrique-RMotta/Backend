<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Cliente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="px-6 py-4 border-b border-gray-200">
                    <p class="text-sm text-gray-600">Edite os dados do cliente.</p>
                </div>

                <form action="{{ route('clientes.update', $cliente->id) }}" method="POST" class="px-6 py-6 space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nome <span class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name', $cliente->name) }}"
                            class="w-full px-3 py-2 text-sm border @error('name') border-red-400 @else border-gray-300 @enderror rounded-md text-gray-900 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400">
                        @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="cpf" class="block text-sm font-medium text-gray-700 mb-1">CPF <span class="text-red-500">*</span></label>
                        <input type="text" id="cpf" name="cpf" value="{{ old('cpf', $cliente->cpf) }}"
                            class="w-full px-3 py-2 text-sm border @error('cpf') border-red-400 @else border-gray-300 @enderror rounded-md text-gray-900 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400">
                        @error('cpf') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail <span class="text-red-500">*</span></label>
                        <input type="email" id="email" name="email" value="{{ old('email', $cliente->email) }}"
                            class="w-full px-3 py-2 text-sm border @error('email') border-red-400 @else border-gray-300 @enderror rounded-md text-gray-900 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400">
                        @error('email') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="telefone" class="block text-sm font-medium text-gray-700 mb-1">Telefone <span class="text-red-500">*</span></label>
                        <input type="text" id="telefone" name="telefone" value="{{ old('telefone', $cliente->telefone) }}"
                            class="w-full px-3 py-2 text-sm border @error('telefone') border-red-400 @else border-gray-300 @enderror rounded-md text-gray-900 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400">
                        @error('telefone') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-2 border-t border-gray-100">
                        <a href="{{ route('clientes.index') }}" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors duration-150">
                            Cancelar
                        </a>
                        <button type="submit" class="px-4 py-2 bg-gray-800 text-white text-sm font-semibold rounded-md hover:bg-gray-700 active:bg-gray-900 transition ease-in-out duration-150">
                            Atualizar Cliente
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>