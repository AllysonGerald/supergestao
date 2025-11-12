@extends('layouts.admin')
@section('title', 'Editar Fornecedor')
@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-gray-900">Editar Fornecedor</h1>
        <a href="{{ route('admin.fornecedores.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-lg font-medium transition"><i class="fas fa-arrow-left mr-2"></i>Voltar</a>
    </div>
    <form action="{{ route('admin.fornecedores.update', $fornecedor) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Dados Básicos</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2"><label class="block text-sm font-medium text-gray-700 mb-2">Nome *</label><input type="text" name="nome" value="{{ old('nome', $fornecedor->nome) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg"></div>
                <div class="md:col-span-2"><label class="block text-sm font-medium text-gray-700 mb-2">Razão Social *</label><input type="text" name="razao_social" value="{{ old('razao_social', $fornecedor->razao_social) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-2">CNPJ *</label><input type="text" name="cnpj" value="{{ old('cnpj', $fornecedor->cnpj) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-2">E-mail *</label><input type="email" name="email" value="{{ old('email', $fornecedor->email) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-2">Telefone *</label><input type="text" name="telefone" value="{{ old('telefone', $fornecedor->telefone) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-2">Celular</label><input type="text" name="celular" value="{{ old('celular', $fornecedor->celular) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg"></div>
                <div class="md:col-span-2"><label class="block text-sm font-medium text-gray-700 mb-2">Nome do Contato</label><input type="text" name="contato_nome" value="{{ old('contato_nome', $fornecedor->contato_nome) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg"></div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Endereço</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div><label class="block text-sm font-medium text-gray-700 mb-2">CEP *</label><input type="text" name="cep" value="{{ old('cep', $fornecedor->cep) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg"></div>
                <div class="md:col-span-2"><label class="block text-sm font-medium text-gray-700 mb-2">Endereço *</label><input type="text" name="endereco" value="{{ old('endereco', $fornecedor->endereco) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-2">Número *</label><input type="text" name="numero" value="{{ old('numero', $fornecedor->numero) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg"></div>
                <div class="md:col-span-2"><label class="block text-sm font-medium text-gray-700 mb-2">Complemento</label><input type="text" name="complemento" value="{{ old('complemento', $fornecedor->complemento) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-2">Bairro *</label><input type="text" name="bairro" value="{{ old('bairro', $fornecedor->bairro) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-2">Cidade *</label><input type="text" name="cidade" value="{{ old('cidade', $fornecedor->cidade) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-2">Estado *</label><select name="estado" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">@foreach(['AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO'] as $uf)<option value="{{ $uf }}" {{ $fornecedor->estado == $uf ? 'selected' : '' }}>{{ $uf }}</option>@endforeach</select></div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Observações</label>
            <textarea name="observacoes" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg">{{ old('observacoes', $fornecedor->observacoes) }}</textarea>
            <div class="mt-4"><label class="flex items-center"><input type="checkbox" name="ativo" value="1" {{ $fornecedor->ativo ? 'checked' : '' }} class="w-4 h-4 text-indigo-600 border-gray-300 rounded"><span class="ml-2 text-sm text-gray-700">Fornecedor ativo</span></label></div>
        </div>
        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.fornecedores.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-lg font-medium transition">Cancelar</a>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium transition"><i class="fas fa-save mr-2"></i>Atualizar Fornecedor</button>
        </div>
    </form>
</div>
@endsection

