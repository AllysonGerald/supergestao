@extends('layouts.admin')
@section('content')
<div class="space-y-6">
    <div class="flex justify-between"><h1 class="text-3xl font-bold">{{ $produto->nome }}</h1><div class="flex space-x-2"><a href="{{ route('admin.produtos.edit', $produto) }}" class="bg-indigo-600 text-white px-6 py-3 rounded-lg"><i class="fas fa-edit mr-2"></i>Editar</a><a href="{{ route('admin.produtos.index') }}" class="bg-gray-200 px-6 py-3 rounded-lg"><i class="fas fa-arrow-left mr-2"></i>Voltar</a></div></div>
    <div class="bg-white rounded-xl shadow-lg p-6"><h2 class="text-xl font-bold mb-6">Detalhes do Produto</h2><dl class="grid md:grid-cols-2 gap-4">
        <div><dt class="text-sm font-medium text-gray-500">Nome</dt><dd class="mt-1">{{ $produto->nome }}</dd></div>
        <div><dt class="text-sm font-medium text-gray-500">SKU</dt><dd class="mt-1">{{ $produto->codigo_sku }}</dd></div>
        <div><dt class="text-sm font-medium text-gray-500">Categoria</dt><dd class="mt-1">{{ $produto->categoria ?? '-' }}</dd></div>
        <div><dt class="text-sm font-medium text-gray-500">Fornecedor</dt><dd class="mt-1">{{ $produto->fornecedor->nome ?? '-' }}</dd></div>
        <div><dt class="text-sm font-medium text-gray-500">Preço Custo</dt><dd class="mt-1">R$ {{ number_format($produto->preco_custo, 2, ',', '.') }}</dd></div>
        <div><dt class="text-sm font-medium text-gray-500">Preço Venda</dt><dd class="mt-1 font-semibold text-green-600">R$ {{ number_format($produto->preco_venda, 2, ',', '.') }}</dd></div>
        <div><dt class="text-sm font-medium text-gray-500">Margem de Lucro</dt><dd class="mt-1">{{ number_format($produto->margem_lucro, 2) }}%</dd></div>
        <div><dt class="text-sm font-medium text-gray-500">Unidade</dt><dd class="mt-1">{{ $produto->unidade_medida }}</dd></div>
        <div><dt class="text-sm font-medium text-gray-500">Estoque Mínimo</dt><dd class="mt-1">{{ $produto->estoque_minimo }}</dd></div>
        <div><dt class="text-sm font-medium text-gray-500">Estoque Atual</dt><dd class="mt-1"><span class="px-2 py-1 text-xs font-medium rounded-full {{ $produto->isEstoqueBaixo() ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">{{ $produto->estoque_atual }}</span></dd></div>
        <div><dt class="text-sm font-medium text-gray-500">Status</dt><dd class="mt-1"><span class="px-2 py-1 text-xs font-medium rounded-full {{ $produto->ativo ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">{{ $produto->ativo ? 'Ativo' : 'Inativo' }}</span></dd></div>
        @if($produto->descricao)<div class="md:col-span-2"><dt class="text-sm font-medium text-gray-500">Descrição</dt><dd class="mt-1">{{ $produto->descricao }}</dd></div>@endif
    </dl></div>
</div>
@endsection

