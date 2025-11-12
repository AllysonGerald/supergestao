@extends('layouts.admin')
@section('title', 'Detalhes do Fornecedor')
@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-gray-900">{{ $fornecedor->nome }}</h1>
        <div class="flex space-x-2">
            <a href="{{ route('admin.fornecedores.edit', $fornecedor) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium transition"><i class="fas fa-edit mr-2"></i>Editar</a>
            <a href="{{ route('admin.fornecedores.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-lg font-medium transition"><i class="fas fa-arrow-left mr-2"></i>Voltar</a>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-6">Informações Básicas</h2>
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div><dt class="text-sm font-medium text-gray-500">Nome</dt><dd class="mt-1 text-sm text-gray-900">{{ $fornecedor->nome }}</dd></div>
            <div><dt class="text-sm font-medium text-gray-500">Razão Social</dt><dd class="mt-1 text-sm text-gray-900">{{ $fornecedor->razao_social }}</dd></div>
            <div><dt class="text-sm font-medium text-gray-500">CNPJ</dt><dd class="mt-1 text-sm text-gray-900">{{ $fornecedor->cnpj }}</dd></div>
            <div><dt class="text-sm font-medium text-gray-500">Status</dt><dd class="mt-1"><span class="px-2 py-1 text-xs font-medium rounded-full {{ $fornecedor->ativo ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">{{ $fornecedor->ativo ? 'Ativo' : 'Inativo' }}</span></dd></div>
            <div><dt class="text-sm font-medium text-gray-500">E-mail</dt><dd class="mt-1 text-sm text-gray-900">{{ $fornecedor->email }}</dd></div>
            <div><dt class="text-sm font-medium text-gray-500">Telefone</dt><dd class="mt-1 text-sm text-gray-900">{{ $fornecedor->telefone }}</dd></div>
            @if($fornecedor->celular)
            <div><dt class="text-sm font-medium text-gray-500">Celular</dt><dd class="mt-1 text-sm text-gray-900">{{ $fornecedor->celular }}</dd></div>
            @endif
            @if($fornecedor->contato_nome)
            <div><dt class="text-sm font-medium text-gray-500">Contato</dt><dd class="mt-1 text-sm text-gray-900">{{ $fornecedor->contato_nome }}</dd></div>
            @endif
        </dl>
    </div>
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-6">Endereço</h2>
        <p class="text-sm text-gray-900">{{ $fornecedor->endereco }}, {{ $fornecedor->numero }}@if($fornecedor->complemento), {{ $fornecedor->complemento }}@endif<br>{{ $fornecedor->bairro }} - {{ $fornecedor->cidade }}/{{ $fornecedor->estado }}<br>CEP: {{ $fornecedor->cep }}</p>
    </div>
    @if($fornecedor->produtos->count() > 0)
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-6">Produtos Fornecidos ({{ $fornecedor->produtos->count() }})</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($fornecedor->produtos as $produto)
            <div class="p-4 bg-gray-50 rounded-lg"><div class="font-semibold text-gray-900">{{ $produto->nome }}</div><div class="text-sm text-gray-600">{{ $produto->codigo_sku }}</div><div class="text-sm text-gray-500 mt-1">Estoque: {{ $produto->estoque_atual }}</div></div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection

