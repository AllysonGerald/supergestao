@extends('layouts.admin')
@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Pedidos</h1>
            <p class="text-gray-600 mt-1">Gerencie os pedidos do sistema</p>
        </div>
        <a href="{{ route('admin.pedidos.create') }}" 
           class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 font-medium">
            <i class="fas fa-plus mr-2"></i>
            Novo Pedido
        </a>
    </div>
    <!-- Filtros de Busca -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <form action="{{ route('admin.pedidos.index') }}" method="GET" class="grid md:grid-cols-4 gap-4">
            <div class="md:col-span-2">
                <input type="text" 
                       name="busca" 
                       value="{{ request('busca') }}" 
                       placeholder="Buscar por número ou cliente..." 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            </div>
            <div>
                <select name="status" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <option value="">Todos status</option>
                    <option value="pendente" {{ request('status') == 'pendente' ? 'selected' : '' }}>Pendente</option>
                    <option value="processando" {{ request('status') == 'processando' ? 'selected' : '' }}>Processando</option>
                    <option value="enviado" {{ request('status') == 'enviado' ? 'selected' : '' }}>Enviado</option>
                    <option value="entregue" {{ request('status') == 'entregue' ? 'selected' : '' }}>Entregue</option>
                    <option value="cancelado" {{ request('status') == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                </select>
            </div>
            <div class="flex space-x-2">
                <button type="submit" 
                        class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                    <i class="fas fa-search mr-2"></i>Buscar
                </button>
                <a href="{{ route('admin.pedidos.index') }}" 
                   class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-lg transition-colors duration-200">
                    <i class="fas fa-times"></i>
                </a>
            </div>
        </form>
    </div>
    <!-- Tabela de Pedidos -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        @if($pedidos->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pedido</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cliente</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Valor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($pedidos as $pedido)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="font-medium text-gray-900">{{ $pedido->numero_pedido }}</div>
                            <div class="text-sm text-gray-500">por {{ $pedido->user->name }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $pedido->cliente->nome }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $pedido->data_pedido->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 font-semibold text-gray-900">R$ {{ number_format($pedido->valor_final, 2, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full
                                {{ $pedido->status == 'pendente' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $pedido->status == 'processando' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $pedido->status == 'enviado' ? 'bg-indigo-100 text-indigo-800' : '' }}
                                {{ $pedido->status == 'entregue' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $pedido->status == 'cancelado' ? 'bg-red-100 text-red-800' : '' }}">
                                {{ ucfirst($pedido->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-3">
                            <a href="{{ route('admin.pedidos.show', $pedido) }}" 
                               class="text-blue-600 hover:text-blue-800 transition-colors"
                               title="Ver detalhes">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.pedidos.edit', $pedido) }}" 
                               class="text-indigo-600 hover:text-indigo-800 transition-colors"
                               title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.pedidos.destroy', $pedido) }}" 
                                  method="POST" 
                                  class="inline" 
                                  onsubmit="return confirm('Tem certeza que deseja excluir este pedido?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-600 hover:text-red-800 transition-colors"
                                        title="Excluir">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            {{ $pedidos->links() }}
        </div>
        @else
        <div class="text-center py-12">
            <i class="fas fa-shopping-cart text-6xl text-gray-300 mb-4"></i>
            <p class="text-gray-500 text-lg">Nenhum pedido encontrado</p>
        </div>
        @endif
    </div>
</div>
@endsection

