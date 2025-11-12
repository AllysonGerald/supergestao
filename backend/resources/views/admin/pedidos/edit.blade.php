@extends('layouts.admin')
@section('content')
<div class="space-y-6">
    <div class="flex justify-between"><h1 class="text-3xl font-bold">Editar Pedido #{{ $pedido->numero_pedido }}</h1><a href="{{ route('admin.pedidos.index') }}" class="bg-gray-200 px-6 py-3 rounded-lg"><i class="fas fa-arrow-left mr-2"></i>Voltar</a></div>
    <form action="{{ route('admin.pedidos.update', $pedido) }}" method="POST" class="space-y-6">@csrf @method('PUT')
        <div class="bg-white rounded-xl shadow-lg p-6"><h2 class="text-xl font-bold mb-6">Dados do Pedido</h2><div class="grid md:grid-cols-2 gap-6">
            <div><label class="block text-sm font-medium mb-2">Cliente *</label><select name="cliente_id" required class="w-full px-4 py-2 border rounded-lg">@foreach($clientes as $c)<option value="{{ $c->id }}" {{ $pedido->cliente_id == $c->id ? 'selected' : '' }}>{{ $c->nome }}</option>@endforeach</select></div>
            <div><label class="block text-sm font-medium mb-2">Data Pedido *</label><input type="date" name="data_pedido" value="{{ $pedido->data_pedido->format('Y-m-d') }}" required class="w-full px-4 py-2 border rounded-lg"></div>
            <div><label class="block text-sm font-medium mb-2">Data Entrega Prevista</label><input type="date" name="data_entrega_prevista" value="{{ $pedido->data_entrega_prevista?->format('Y-m-d') }}" class="w-full px-4 py-2 border rounded-lg"></div>
            <div><label class="block text-sm font-medium mb-2">Status *</label><select name="status" required class="w-full px-4 py-2 border rounded-lg"><option value="pendente" {{ $pedido->status == 'pendente' ? 'selected' : '' }}>Pendente</option><option value="processando" {{ $pedido->status == 'processando' ? 'selected' : '' }}>Processando</option><option value="enviado" {{ $pedido->status == 'enviado' ? 'selected' : '' }}>Enviado</option><option value="entregue" {{ $pedido->status == 'entregue' ? 'selected' : '' }}>Entregue</option><option value="cancelado" {{ $pedido->status == 'cancelado' ? 'selected' : '' }}>Cancelado</option></select></div>
            <div><label class="block text-sm font-medium mb-2">Desconto</label><input type="number" step="0.01" name="desconto" value="{{ $pedido->desconto }}" class="w-full px-4 py-2 border rounded-lg"></div>
            <div class="md:col-span-2"><label class="block text-sm font-medium mb-2">Observações</label><textarea name="observacoes" rows="2" class="w-full px-4 py-2 border rounded-lg">{{ $pedido->observacoes }}</textarea></div>
        </div></div>
        <div class="flex justify-end space-x-4"><a href="{{ route('admin.pedidos.index') }}" class="bg-gray-200 px-6 py-3 rounded-lg">Cancelar</a><button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-lg"><i class="fas fa-save mr-2"></i>Atualizar</button></div>
    </form>
</div>
@endsection

