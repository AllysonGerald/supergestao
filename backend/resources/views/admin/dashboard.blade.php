@extends('layouts.admin')

@section('title', 'Dashboard - Super Gestão')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
            <p class="text-gray-600 mt-1">Bem-vindo, {{ auth()->user()->name }}!</p>
        </div>
        <div class="text-sm text-gray-500">
            <i class="fas fa-calendar mr-2"></i>
            {{ now()->format('d/m/Y') }}
        </div>
    </div>

    <!-- Cards de Estatísticas -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total de Clientes -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium">Clientes</p>
                    <h3 class="text-3xl font-bold mt-2">{{ $totalClientes }}</h3>
                </div>
                <div class="bg-blue-400/30 rounded-full p-4">
                    <i class="fas fa-users text-2xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm text-blue-100">
                <i class="fas fa-arrow-up mr-1"></i>
                <span>Ativos no sistema</span>
            </div>
        </div>

        <!-- Total de Produtos -->
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium">Produtos</p>
                    <h3 class="text-3xl font-bold mt-2">{{ $totalProdutos }}</h3>
                </div>
                <div class="bg-green-400/30 rounded-full p-4">
                    <i class="fas fa-box text-2xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm text-green-100">
                @if($produtosEstoqueBaixo > 0)
                    <i class="fas fa-exclamation-triangle mr-1"></i>
                    <span>{{ $produtosEstoqueBaixo }} com estoque baixo</span>
                @else
                    <i class="fas fa-check mr-1"></i>
                    <span>Estoque OK</span>
                @endif
            </div>
        </div>

        <!-- Total de Pedidos -->
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm font-medium">Pedidos</p>
                    <h3 class="text-3xl font-bold mt-2">{{ $totalPedidos }}</h3>
                </div>
                <div class="bg-purple-400/30 rounded-full p-4">
                    <i class="fas fa-shopping-cart text-2xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm text-purple-100">
                <i class="fas fa-chart-line mr-1"></i>
                <span>Total de pedidos</span>
            </div>
        </div>

        <!-- Faturamento do Mês -->
        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100 text-sm font-medium">Faturamento</p>
                    <h3 class="text-3xl font-bold mt-2">R$ {{ number_format($valorPedidosMes, 2, ',', '.') }}</h3>
                </div>
                <div class="bg-orange-400/30 rounded-full p-4">
                    <i class="fas fa-dollar-sign text-2xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm text-orange-100">
                <i class="fas fa-calendar mr-1"></i>
                <span>Mês atual</span>
            </div>
        </div>
    </div>

    <!-- Grid com 2 colunas -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Últimos Pedidos -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900">Últimos Pedidos</h2>
                <a href="{{ route('admin.pedidos.index') }}" class="text-indigo-600 hover:text-indigo-700 text-sm font-medium">
                    Ver todos <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            
            @if($ultimosPedidos->count() > 0)
                <div class="space-y-4">
                    @foreach($ultimosPedidos as $pedido)
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                            <div class="flex-1">
                                <div class="flex items-center space-x-2">
                                    <span class="font-semibold text-gray-900">{{ $pedido->numero_pedido }}</span>
                                    <span class="px-2 py-1 text-xs rounded-full 
                                        {{ $pedido->status == 'pendente' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $pedido->status == 'processando' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $pedido->status == 'enviado' ? 'bg-indigo-100 text-indigo-800' : '' }}
                                        {{ $pedido->status == 'entregue' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $pedido->status == 'cancelado' ? 'bg-red-100 text-red-800' : '' }}">
                                        {{ ucfirst($pedido->status) }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600 mt-1">{{ $pedido->cliente->nome }}</p>
                                <p class="text-xs text-gray-500 mt-1">{{ $pedido->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-gray-900">R$ {{ number_format($pedido->valor_final, 2, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8 text-gray-500">
                    <i class="fas fa-shopping-cart text-4xl mb-2"></i>
                    <p>Nenhum pedido ainda</p>
                </div>
            @endif
        </div>

        <!-- Produtos Mais Vendidos -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900">Produtos Mais Vendidos</h2>
                <a href="{{ route('admin.produtos.index') }}" class="text-indigo-600 hover:text-indigo-700 text-sm font-medium">
                    Ver todos <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            
            @if($produtosMaisVendidos->count() > 0)
                <div class="space-y-4">
                    @foreach($produtosMaisVendidos as $produto)
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                                    @if($produto->imagem)
                                        <img src="{{ asset('storage/' . $produto->imagem) }}" alt="{{ $produto->nome }}" class="w-full h-full object-cover rounded-lg">
                                    @else
                                        <i class="fas fa-box text-indigo-600"></i>
                                    @endif
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $produto->nome }}</p>
                                    <p class="text-sm text-gray-600">{{ $produto->codigo_sku }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-gray-900">{{ $produto->total_vendido ?? 0 }}</p>
                                <p class="text-xs text-gray-500">vendidos</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8 text-gray-500">
                    <i class="fas fa-box text-4xl mb-2"></i>
                    <p>Nenhuma venda ainda</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Pedidos por Status -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-6">Pedidos por Status</h2>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
            <div class="text-center p-4 bg-yellow-50 rounded-lg">
                <p class="text-2xl font-bold text-yellow-600">{{ $pedidosPorStatus['pendente'] ?? 0 }}</p>
                <p class="text-sm text-gray-600 mt-1">Pendente</p>
            </div>
            <div class="text-center p-4 bg-blue-50 rounded-lg">
                <p class="text-2xl font-bold text-blue-600">{{ $pedidosPorStatus['processando'] ?? 0 }}</p>
                <p class="text-sm text-gray-600 mt-1">Processando</p>
            </div>
            <div class="text-center p-4 bg-indigo-50 rounded-lg">
                <p class="text-2xl font-bold text-indigo-600">{{ $pedidosPorStatus['enviado'] ?? 0 }}</p>
                <p class="text-sm text-gray-600 mt-1">Enviado</p>
            </div>
            <div class="text-center p-4 bg-green-50 rounded-lg">
                <p class="text-2xl font-bold text-green-600">{{ $pedidosPorStatus['entregue'] ?? 0 }}</p>
                <p class="text-sm text-gray-600 mt-1">Entregue</p>
            </div>
            <div class="text-center p-4 bg-red-50 rounded-lg">
                <p class="text-2xl font-bold text-red-600">{{ $pedidosPorStatus['cancelado'] ?? 0 }}</p>
                <p class="text-sm text-gray-600 mt-1">Cancelado</p>
            </div>
        </div>
    </div>

    <!-- Ações Rápidas -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-6">Ações Rápidas</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('admin.pedidos.create') }}" class="flex flex-col items-center justify-center p-6 bg-indigo-50 hover:bg-indigo-100 rounded-lg transition">
                <i class="fas fa-plus-circle text-3xl text-indigo-600 mb-2"></i>
                <span class="text-sm font-medium text-gray-900">Novo Pedido</span>
            </a>
            <a href="{{ route('admin.clientes.create') }}" class="flex flex-col items-center justify-center p-6 bg-blue-50 hover:bg-blue-100 rounded-lg transition">
                <i class="fas fa-user-plus text-3xl text-blue-600 mb-2"></i>
                <span class="text-sm font-medium text-gray-900">Novo Cliente</span>
            </a>
            <a href="{{ route('admin.produtos.create') }}" class="flex flex-col items-center justify-center p-6 bg-green-50 hover:bg-green-100 rounded-lg transition">
                <i class="fas fa-box text-3xl text-green-600 mb-2"></i>
                <span class="text-sm font-medium text-gray-900">Novo Produto</span>
            </a>
            <a href="{{ route('admin.fornecedores.create') }}" class="flex flex-col items-center justify-center p-6 bg-orange-50 hover:bg-orange-100 rounded-lg transition">
                <i class="fas fa-truck text-3xl text-orange-600 mb-2"></i>
                <span class="text-sm font-medium text-gray-900">Novo Fornecedor</span>
            </a>
        </div>
    </div>
</div>
@endsection

