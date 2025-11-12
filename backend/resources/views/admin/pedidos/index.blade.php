@extends('layouts.admin')
@section('content')
<div class="space-y-6">
    <div class="flex justify-between"><div><h1 class="text-3xl font-bold">Pedidos</h1><p class="text-gray-600 mt-1">Gerencie os pedidos do sistema</p></div><a href="{{ route('admin.pedidos.create') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-lg"><i class="fas fa-plus mr-2"></i>Novo Pedido</a></div>
    <div class="bg-white rounded-xl shadow-lg p-6"><form action="{{ route('admin.pedidos.index') }}" method="GET" class="grid md:grid-cols-4 gap-4">
        <div class="md:col-span-2"><input type="text" name="busca" value="{{ request('busca') }}" placeholder="Buscar por número ou cliente..." class="w-full px-4 py-2 border rounded-lg"></div>
        <div><select name="status" class="w-full px-4 py-2 border rounded-lg"><option value="">Todos status</option><option value="pendente">Pendente</option><option value="processando">Processando</option><option value="enviado">Enviado</option><option value="entregue">Entregue</option><option value="cancelado">Cancelado</option></select></div>
        <div class="flex space-x-2"><button type="submit" class="flex-1 bg-indigo-600 text-white px-4 py-2 rounded-lg"><i class="fas fa-search mr-2"></i>Buscar</button><a href="{{ route('admin.pedidos.index') }}" class="bg-gray-200 px-4 py-2 rounded-lg"><i class="fas fa-times"></i></a></div>
    </form></div>
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        @if($pedidos->count() > 0)
        <div class="overflow-x-auto"><table class="min-w-full divide-y divide-gray-200"><thead class="bg-gray-50"><tr><th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pedido</th><th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Cliente</th><th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Data</th><th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Valor</th><th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th><th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Ações</th></tr></thead><tbody class="divide-y">
            @foreach($pedidos as $pedido)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4"><div class="font-medium text-gray-900">{{ $pedido->numero_pedido }}</div><div class="text-sm text-gray-500">por {{ $pedido->user->name }}</div></td>
                <td class="px-6 py-4 text-sm">{{ $pedido->cliente->nome }}</td>
                <td class="px-6 py-4 text-sm">{{ $pedido->data_pedido->format('d/m/Y') }}</td>
                <td class="px-6 py-4 font-semibold text-gray-900">R$ {{ number_format($pedido->valor_final, 2, ',', '.') }}</td>
                <td class="px-6 py-4"><span class="px-2 py-1 text-xs font-medium rounded-full {{ $pedido->status == 'pendente' ? 'bg-yellow-100 text-yellow-800' : '' }} {{ $pedido->status == 'processando' ? 'bg-blue-100 text-blue-800' : '' }} {{ $pedido->status == 'enviado' ? 'bg-indigo-100 text-indigo-800' : '' }} {{ $pedido->status == 'entregue' ? 'bg-green-100 text-green-800' : '' }} {{ $pedido->status == 'cancelado' ? 'bg-red-100 text-red-800' : '' }}">{{ ucfirst($pedido->status) }}</span></td>
                <td class="px-6 py-4 text-right space-x-2"><a href="{{ route('admin.pedidos.show', $pedido) }}" class="text-blue-600"><i class="fas fa-eye"></i></a><a href="{{ route('admin.pedidos.edit', $pedido) }}" class="text-indigo-600"><i class="fas fa-edit"></i></a><form action="{{ route('admin.pedidos.destroy', $pedido) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza?')">@csrf @method('DELETE')<button type="submit" class="text-red-600"><i class="fas fa-trash"></i></button></form></td>
            </tr>
            @endforeach
        </tbody></table></div>
        <div class="bg-gray-50 px-6 py-4">{{ $pedidos->links() }}</div>
        @else
        <div class="text-center py-12"><i class="fas fa-shopping-cart text-6xl text-gray-300 mb-4"></i><p class="text-gray-500 text-lg">Nenhum pedido encontrado</p></div>
        @endif
    </div>
</div>
@endsection

