@extends('layouts.admin')

@section('title', 'Editar Cliente - Super Gestão')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Editar Cliente</h1>
            <p class="text-gray-600 mt-1">Atualize os dados do cliente</p>
        </div>
        <a href="{{ route('admin.clientes.index') }}" 
           class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-lg font-medium transition flex items-center">
            <i class="fas fa-arrow-left mr-2"></i>
            Voltar
        </a>
    </div>

    <form action="{{ route('admin.clientes.update', $cliente) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Dados Básicos</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label for="nome" class="block text-sm font-medium text-gray-700 mb-2">Nome Completo / Razão Social *</label>
                    <input type="text" name="nome" id="nome" value="{{ old('nome', $cliente->nome) }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('nome') border-red-500 @enderror">
                    @error('nome')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="tipo" class="block text-sm font-medium text-gray-700 mb-2">Tipo *</label>
                    <select name="tipo" id="tipo" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="fisica" {{ old('tipo', $cliente->tipo) == 'fisica' ? 'selected' : '' }}>Pessoa Física</option>
                        <option value="juridica" {{ old('tipo', $cliente->tipo) == 'juridica' ? 'selected' : '' }}>Pessoa Jurídica</option>
                    </select>
                </div>

                <div>
                    <label for="cpf_cnpj" class="block text-sm font-medium text-gray-700 mb-2">CPF / CNPJ *</label>
                    <input type="text" name="cpf_cnpj" id="cpf_cnpj" value="{{ old('cpf_cnpj', $cliente->cpf_cnpj) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">E-mail *</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $cliente->email) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>

                <div>
                    <label for="telefone" class="block text-sm font-medium text-gray-700 mb-2">Telefone *</label>
                    <input type="text" name="telefone" id="telefone" value="{{ old('telefone', $cliente->telefone) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>

                <div>
                    <label for="celular" class="block text-sm font-medium text-gray-700 mb-2">Celular</label>
                    <input type="text" name="celular" id="celular" value="{{ old('celular', $cliente->celular) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Endereço</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="cep" class="block text-sm font-medium text-gray-700 mb-2">CEP *</label>
                    <input type="text" name="cep" id="cep" value="{{ old('cep', $cliente->cep) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>

                <div class="md:col-span-2">
                    <label for="endereco" class="block text-sm font-medium text-gray-700 mb-2">Endereço *</label>
                    <input type="text" name="endereco" id="endereco" value="{{ old('endereco', $cliente->endereco) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>

                <div>
                    <label for="numero" class="block text-sm font-medium text-gray-700 mb-2">Número *</label>
                    <input type="text" name="numero" id="numero" value="{{ old('numero', $cliente->numero) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>

                <div class="md:col-span-2">
                    <label for="complemento" class="block text-sm font-medium text-gray-700 mb-2">Complemento</label>
                    <input type="text" name="complemento" id="complemento" value="{{ old('complemento', $cliente->complemento) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>

                <div>
                    <label for="bairro" class="block text-sm font-medium text-gray-700 mb-2">Bairro *</label>
                    <input type="text" name="bairro" id="bairro" value="{{ old('bairro', $cliente->bairro) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>

                <div>
                    <label for="cidade" class="block text-sm font-medium text-gray-700 mb-2">Cidade *</label>
                    <input type="text" name="cidade" id="cidade" value="{{ old('cidade', $cliente->cidade) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>

                <div>
                    <label for="estado" class="block text-sm font-medium text-gray-700 mb-2">Estado *</label>
                    <select name="estado" id="estado" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                        @foreach(['AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO'] as $uf)
                            <option value="{{ $uf }}" {{ old('estado', $cliente->estado) == $uf ? 'selected' : '' }}>{{ $uf }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Informações Adicionais</h2>
            
            <div>
                <label for="observacoes" class="block text-sm font-medium text-gray-700 mb-2">Observações</label>
                <textarea name="observacoes" id="observacoes" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg">{{ old('observacoes', $cliente->observacoes) }}</textarea>
            </div>

            <div class="mt-4">
                <label class="flex items-center">
                    <input type="checkbox" name="ativo" value="1" {{ old('ativo', $cliente->ativo) ? 'checked' : '' }} class="w-4 h-4 text-indigo-600 border-gray-300 rounded">
                    <span class="ml-2 text-sm text-gray-700">Cliente ativo</span>
                </label>
            </div>
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.clientes.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-lg font-medium transition">Cancelar</a>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium transition">
                <i class="fas fa-save mr-2"></i>Atualizar Cliente
            </button>
        </div>
    </form>
</div>
@endsection

