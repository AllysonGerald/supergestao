@extends('layouts.admin')
@section('content')
<div class="space-y-6">
    <div class="flex justify-between"><h1 class="text-3xl font-bold">Pedido {{ $pedido->numero_pedido }}</h1><div class="flex space-x-2"><a href="{{ route('admin.pedidos.edit', $pedido) }}" class="bg-indigo-600 text-white px-6 py-3 rounded-lg"><i class="fas fa-edit mr-2"></i>Editar</a><a href="{{ route('admin.pedidos.index') }}" class="bg-gray-200 px-6 py-3 rounded-lg"><i class="fas fa-arrow-left mr-2"></i>Voltar</a></div></div>
    <div class="grid md:grid-cols-3 gap-6">
        <div class="md:col-span-2 space-y-6">
            <div class="bg-white rounded-xl shadow-lg p-6"><h2 class="text-xl font-bold mb-6">Informações do Pedido</h2><dl class="grid md:grid-cols-2 gap-4">
                <div><dt class="text-sm font-medium text-gray-500">Número</dt><dd class="mt-1 font-semibold">{{ $pedido->numero_pedido }}</dd></div>
                <div><dt class="text-sm font-medium text-gray-500">Status</dt><dd class="mt-1"><span class="px-2 py-1 text-xs font-medium rounded-full {{ $pedido->status == 'pendente' ? 'bg-yellow-100 text-yellow-800' : '' }} {{ $pedido->status == 'processando' ? 'bg-blue-100 text-blue-800' : '' }} {{ $pedido->status == 'enviado' ? 'bg-indigo-100 text-indigo-800' : '' }} {{ $pedido->status == 'entregue' ? 'bg-green-100 text-green-800' : '' }} {{ $pedido->status == 'cancelado' ? 'bg-red-100 text-red-800' : '' }}">{{ ucfirst($pedido->status) }}</span></dd></div>
                <div><dt class="text-sm font-medium text-gray-500">Cliente</dt><dd class="mt-1">{{ $pedido->cliente->nome }}</dd></div>
                <div><dt class="text-sm font-medium text-gray-500">Responsável</dt><dd class="mt-1">{{ $pedido->user->name }}</dd></div>
                <div><dt class="text-sm font-medium text-gray-500">Data Pedido</dt><dd class="mt-1">{{ $pedido->data_pedido->format('d/m/Y') }}</dd></div>
                @if($pedido->data_entrega_prevista)<div><dt class="text-sm font-medium text-gray-500">Previsão Entrega</dt><dd class="mt-1">{{ $pedido->data_entrega_prevista->format('d/m/Y') }}</dd></div>@endif
            </dl></div>
            <div class="bg-white rounded-xl shadow-lg p-6"><h2 class="text-xl font-bold mb-6">Itens do Pedido</h2>
                <table class="min-w-full"><thead class="bg-gray-50"><tr><th class="px-4 py-2 text-left">Produto</th><th class="px-4 py-2 text-right">Qtd</th><th class="px-4 py-2 text-right">Preço Unit.</th><th class="px-4 py-2 text-right">Subtotal</th></tr></thead><tbody class="divide-y">
                    @foreach($pedido->itens as $item)
                    <tr><td class="px-4 py-3">{{ $item->produto->nome }}</td><td class="px-4 py-3 text-right">{{ $item->quantidade }}</td><td class="px-4 py-3 text-right">R$ {{ number_format($item->preco_unitario, 2, ',', '.') }}</td><td class="px-4 py-3 text-right font-semibold">R$ {{ number_format($item->subtotal, 2, ',', '.') }}</td></tr>
                    @endforeach
                </tbody></table>
            </div>
        </div>
        <div class="space-y-6">
            <div class="bg-white rounded-xl shadow-lg p-6"><h2 class="text-xl font-bold mb-4">Resumo Financeiro</h2><dl class="space-y-3">
                <div class="flex justify-between"><dt class="text-gray-600">Valor Total:</dt><dd class="font-semibold">R$ {{ number_format($pedido->valor_total, 2, ',', '.') }}</dd></div>
                <div class="flex justify-between"><dt class="text-gray-600">Desconto:</dt><dd class="text-red-600">- R$ {{ number_format($pedido->desconto, 2, ',', '.') }}</dd></div>
                <div class="flex justify-between pt-3 border-t"><dt class="text-lg font-bold">Valor Final:</dt><dd class="text-lg font-bold text-green-600">R$ {{ number_format($pedido->valor_final, 2, ',', '.') }}</dd></div>
            </dl></div>
        </div>
    </div>
</div>
@endsection

