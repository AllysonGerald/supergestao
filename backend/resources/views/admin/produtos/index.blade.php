@extends('layouts.admin')
@section('title', 'Produtos')
@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div><h1 class="text-3xl font-bold text-gray-900">Produtos</h1><p class="text-gray-600 mt-1">Gerencie os produtos do sistema</p></div>
        <a href="{{ route('admin.produtos.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium transition flex items-center"><i class="fas fa-plus mr-2"></i>Novo Produto</a>
    </div>
    <div class="bg-white rounded-xl shadow-lg p-6">
        <form action="{{ route('admin.produtos.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="md:col-span-2"><input type="text" name="busca" value="{{ request('busca') }}" placeholder="Buscar por nome, SKU ou categoria..." class="w-full px-4 py-2 border border-gray-300 rounded-lg"></div>
            <div><select name="categoria" class="w-full px-4 py-2 border border-gray-300 rounded-lg"><option value="">Todas categorias</option>@foreach($categorias as $cat)<option value="{{ $cat }}" {{ request('categoria') == $cat ? 'selected' : '' }}>{{ $cat }}</option>@endforeach</select></div>
            <div class="flex space-x-2"><button type="submit" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium"><i class="fas fa-search mr-2"></i>Buscar</button><a href="{{ route('admin.produtos.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg"><i class="fas fa-times"></i></a></div>
        </form>
    </div>
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        @if($produtos->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50"><tr><th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produto</th><th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">SKU</th><th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Categoria</th><th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fornecedor</th><th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Preço Venda</th><th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estoque</th><th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th><th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Ações</th></tr></thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($produtos as $produto)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4"><div class="flex items-center"><div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-green-600 font-semibold">{{ substr($produto->nome, 0, 1) }}</div><div class="ml-4"><div class="text-sm font-medium text-gray-900">{{ $produto->nome }}</div></div></div></td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $produto->codigo_sku }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $produto->categoria }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $produto->fornecedor->nome ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm font-semibold text-gray-900">R$ {{ number_format($produto->preco_venda, 2, ',', '.') }}</td>
                        <td class="px-6 py-4"><span class="px-2 py-1 text-xs font-medium rounded-full {{ $produto->isEstoqueBaixo() ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">{{ $produto->estoque_atual }}</span></td>
                        <td class="px-6 py-4"><span class="px-2 py-1 text-xs font-medium rounded-full {{ $produto->ativo ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">{{ $produto->ativo ? 'Ativo' : 'Inativo' }}</span></td>
                        <td class="px-6 py-4 text-right text-sm font-medium space-x-2"><a href="{{ route('admin.produtos.show', $produto) }}" class="text-blue-600 hover:text-blue-900"><i class="fas fa-eye"></i></a><a href="{{ route('admin.produtos.edit', $produto) }}" class="text-indigo-600 hover:text-indigo-900"><i class="fas fa-edit"></i></a><form action="{{ route('admin.produtos.destroy', $produto) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza?')">@csrf @method('DELETE')<button type="submit" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></button></form></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="bg-gray-50 px-6 py-4">{{ $produtos->links() }}</div>
        @else
        <div class="text-center py-12"><i class="fas fa-box text-6xl text-gray-300 mb-4"></i><p class="text-gray-500 text-lg">Nenhum produto encontrado</p></div>
        @endif
    </div>
</div>
@endsection

