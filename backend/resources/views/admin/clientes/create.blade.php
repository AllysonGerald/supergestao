@extends('layouts.admin')

@section('title', 'Novo Cliente - Super Gestão')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Novo Cliente</h1>
            <p class="text-gray-600 mt-1">Preencha os dados para cadastrar um novo cliente</p>
        </div>
        <a href="{{ route('admin.clientes.index') }}" 
           class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-lg font-medium transition flex items-center">
            <i class="fas fa-arrow-left mr-2"></i>
            Voltar
        </a>
    </div>

    <!-- Formulário -->
    <form action="{{ route('admin.clientes.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Dados Básicos -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Dados Básicos</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label for="nome" class="block text-sm font-medium text-gray-700 mb-2">Nome Completo / Razão Social *</label>
                    <input type="text" name="nome" id="nome" value="{{ old('nome') }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('nome') border-red-500 @enderror">
                    @error('nome')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="tipo" class="block text-sm font-medium text-gray-700 mb-2">Tipo *</label>
                    <select name="tipo" id="tipo" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('tipo') border-red-500 @enderror">
                        <option value="">Selecione...</option>
                        <option value="fisica" {{ old('tipo') == 'fisica' ? 'selected' : '' }}>Pessoa Física</option>
                        <option value="juridica" {{ old('tipo') == 'juridica' ? 'selected' : '' }}>Pessoa Jurídica</option>
                    </select>
                    @error('tipo')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="cpf_cnpj" class="block text-sm font-medium text-gray-700 mb-2">CPF / CNPJ *</label>
                    <input type="text" name="cpf_cnpj" id="cpf_cnpj" value="{{ old('cpf_cnpj') }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('cpf_cnpj') border-red-500 @enderror">
                    @error('cpf_cnpj')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">E-mail *</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="telefone" class="block text-sm font-medium text-gray-700 mb-2">Telefone *</label>
                    <input type="text" name="telefone" id="telefone" value="{{ old('telefone') }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('telefone') border-red-500 @enderror">
                    @error('telefone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="celular" class="block text-sm font-medium text-gray-700 mb-2">Celular</label>
                    <input type="text" name="celular" id="celular" value="{{ old('celular') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('celular') border-red-500 @enderror">
                    @error('celular')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Endereço -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Endereço</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="cep" class="block text-sm font-medium text-gray-700 mb-2">CEP *</label>
                    <input type="text" name="cep" id="cep" value="{{ old('cep') }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('cep') border-red-500 @enderror">
                    @error('cep')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="endereco" class="block text-sm font-medium text-gray-700 mb-2">Endereço *</label>
                    <input type="text" name="endereco" id="endereco" value="{{ old('endereco') }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('endereco') border-red-500 @enderror">
                    @error('endereco')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="numero" class="block text-sm font-medium text-gray-700 mb-2">Número *</label>
                    <input type="text" name="numero" id="numero" value="{{ old('numero') }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('numero') border-red-500 @enderror">
                    @error('numero')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="complemento" class="block text-sm font-medium text-gray-700 mb-2">Complemento</label>
                    <input type="text" name="complemento" id="complemento" value="{{ old('complemento') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('complemento') border-red-500 @enderror">
                    @error('complemento')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="bairro" class="block text-sm font-medium text-gray-700 mb-2">Bairro *</label>
                    <input type="text" name="bairro" id="bairro" value="{{ old('bairro') }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('bairro') border-red-500 @enderror">
                    @error('bairro')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="cidade" class="block text-sm font-medium text-gray-700 mb-2">Cidade *</label>
                    <input type="text" name="cidade" id="cidade" value="{{ old('cidade') }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('cidade') border-red-500 @enderror">
                    @error('cidade')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="estado" class="block text-sm font-medium text-gray-700 mb-2">Estado *</label>
                    <select name="estado" id="estado" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('estado') border-red-500 @enderror">
                        <option value="">Selecione...</option>
                        <option value="AC">AC</option>
                        <option value="AL">AL</option>
                        <option value="AP">AP</option>
                        <option value="AM">AM</option>
                        <option value="BA">BA</option>
                        <option value="CE">CE</option>
                        <option value="DF">DF</option>
                        <option value="ES">ES</option>
                        <option value="GO">GO</option>
                        <option value="MA">MA</option>
                        <option value="MT">MT</option>
                        <option value="MS">MS</option>
                        <option value="MG">MG</option>
                        <option value="PA">PA</option>
                        <option value="PB">PB</option>
                        <option value="PR">PR</option>
                        <option value="PE">PE</option>
                        <option value="PI">PI</option>
                        <option value="RJ">RJ</option>
                        <option value="RN">RN</option>
                        <option value="RS">RS</option>
                        <option value="RO">RO</option>
                        <option value="RR">RR</option>
                        <option value="SC">SC</option>
                        <option value="SP">SP</option>
                        <option value="SE">SE</option>
                        <option value="TO">TO</option>
                    </select>
                    @error('estado')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Observações -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Informações Adicionais</h2>
            
            <div>
                <label for="observacoes" class="block text-sm font-medium text-gray-700 mb-2">Observações</label>
                <textarea name="observacoes" id="observacoes" rows="4"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('observacoes') border-red-500 @enderror">{{ old('observacoes') }}</textarea>
                @error('observacoes')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4">
                <label class="flex items-center">
                    <input type="checkbox" name="ativo" value="1" {{ old('ativo', true) ? 'checked' : '' }}
                           class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                    <span class="ml-2 text-sm text-gray-700">Cliente ativo</span>
                </label>
            </div>
        </div>

        <!-- Botões -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.clientes.index') }}" 
               class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-lg font-medium transition">
                Cancelar
            </a>
            <button type="submit" 
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium transition">
                <i class="fas fa-save mr-2"></i>
                Salvar Cliente
            </button>
        </div>
    </form>
</div>
@endsection

