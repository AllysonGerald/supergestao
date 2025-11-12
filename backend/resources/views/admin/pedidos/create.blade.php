@extends('layouts.admin')
@section('content')
<div class="space-y-6">
    <div class="flex justify-between"><h1 class="text-3xl font-bold">Novo Pedido</h1><a href="{{ route('admin.pedidos.index') }}" class="bg-gray-200 px-6 py-3 rounded-lg"><i class="fas fa-arrow-left mr-2"></i>Voltar</a></div>
    <form action="{{ route('admin.pedidos.store') }}" method="POST" x-data="pedidoForm()" class="space-y-6">@csrf
        <div class="bg-white rounded-xl shadow-lg p-6"><h2 class="text-xl font-bold mb-6">Dados do Pedido</h2><div class="grid md:grid-cols-2 gap-6">
            <div><label class="block text-sm font-medium mb-2">Cliente *</label><select name="cliente_id" required class="w-full px-4 py-2 border rounded-lg">@foreach($clientes as $c)<option value="{{ $c->id }}">{{ $c->nome }}</option>@endforeach</select></div>
            <div><label class="block text-sm font-medium mb-2">Data Pedido *</label><input type="date" name="data_pedido" value="{{ date('Y-m-d') }}" required class="w-full px-4 py-2 border rounded-lg"></div>
            <div><label class="block text-sm font-medium mb-2">Data Entrega Prevista</label><input type="date" name="data_entrega_prevista" class="w-full px-4 py-2 border rounded-lg"></div>
            <div><label class="block text-sm font-medium mb-2">Status *</label><select name="status" required class="w-full px-4 py-2 border rounded-lg"><option value="pendente">Pendente</option><option value="processando">Processando</option><option value="enviado">Enviado</option><option value="entregue">Entregue</option><option value="cancelado">Cancelado</option></select></div>
            <div class="md:col-span-2"><label class="block text-sm font-medium mb-2">Observações</label><textarea name="observacoes" rows="2" class="w-full px-4 py-2 border rounded-lg"></textarea></div>
        </div></div>
        <div class="bg-white rounded-xl shadow-lg p-6"><h2 class="text-xl font-bold mb-6">Itens do Pedido</h2>
            <div class="space-y-4"><template x-for="(item, index) in items" :key="index"><div class="grid md:grid-cols-5 gap-4 p-4 bg-gray-50 rounded-lg">
                <div class="md:col-span-2"><select :name="'produtos['+index+'][produto_id]'" required class="w-full px-4 py-2 border rounded-lg">@foreach($produtos as $p)<option value="{{ $p->id }}" data-preco="{{ $p->preco_venda }}">{{ $p->nome }} (R$ {{ number_format($p->preco_venda, 2, ',', '.') }})</option>@endforeach</select></div>
                <div><input type="number" :name="'produtos['+index+'][quantidade]'" placeholder="Qtd" min="1" required class="w-full px-4 py-2 border rounded-lg"></div>
                <div><input type="number" step="0.01" :name="'produtos['+index+'][preco_unitario]'" placeholder="Preço" required class="w-full px-4 py-2 border rounded-lg"></div>
                <div><button type="button" @click="removeItem(index)" class="w-full bg-red-500 text-white px-4 py-2 rounded-lg"><i class="fas fa-trash"></i></button></div>
            </div></template></div>
            <button type="button" @click="addItem()" class="mt-4 bg-green-600 text-white px-4 py-2 rounded-lg"><i class="fas fa-plus mr-2"></i>Adicionar Item</button>
            <div class="mt-6"><label class="block text-sm font-medium mb-2">Desconto</label><input type="number" step="0.01" name="desconto" value="0" class="w-full px-4 py-2 border rounded-lg"></div>
        </div>
        <div class="flex justify-end space-x-4"><a href="{{ route('admin.pedidos.index') }}" class="bg-gray-200 px-6 py-3 rounded-lg">Cancelar</a><button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-lg"><i class="fas fa-save mr-2"></i>Salvar Pedido</button></div>
    </form>
</div>
<script>
function pedidoForm() {
    return {
        items: [{}],
        addItem() { this.items.push({}); },
        removeItem(index) { if(this.items.length > 1) this.items.splice(index, 1); }
    }
}
</script>
@endsection

