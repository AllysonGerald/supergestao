@extends('layouts.admin')
@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center"><h1 class="text-3xl font-bold">Novo Produto</h1><a href="{{ route('admin.produtos.index') }}" class="bg-gray-200 px-6 py-3 rounded-lg"><i class="fas fa-arrow-left mr-2"></i>Voltar</a></div>
    <form action="{{ route('admin.produtos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">@csrf
        <div class="bg-white rounded-xl shadow-lg p-6"><h2 class="text-xl font-bold mb-6">Dados do Produto</h2><div class="grid md:grid-cols-2 gap-6">
            <div class="md:col-span-2"><label class="block text-sm font-medium mb-2">Nome *</label><input type="text" name="nome" required class="w-full px-4 py-2 border rounded-lg"></div>
            <div><label class="block text-sm font-medium mb-2">Código SKU *</label><input type="text" name="codigo_sku" required class="w-full px-4 py-2 border rounded-lg"></div>
            <div><label class="block text-sm font-medium mb-2">Categoria</label><input type="text" name="categoria" class="w-full px-4 py-2 border rounded-lg"></div>
            <div><label class="block text-sm font-medium mb-2">Fornecedor</label><select name="fornecedor_id" class="w-full px-4 py-2 border rounded-lg"><option value="">Selecione...</option>@foreach($fornecedores as $f)<option value="{{ $f->id }}">{{ $f->nome }}</option>@endforeach</select></div>
            <div><label class="block text-sm font-medium mb-2">Unidade Medida *</label><input type="text" name="unidade_medida" value="UN" required class="w-full px-4 py-2 border rounded-lg"></div>
            <div><label class="block text-sm font-medium mb-2">Preço Custo *</label><input type="number" step="0.01" name="preco_custo" required class="w-full px-4 py-2 border rounded-lg"></div>
            <div><label class="block text-sm font-medium mb-2">Preço Venda *</label><input type="number" step="0.01" name="preco_venda" required class="w-full px-4 py-2 border rounded-lg"></div>
            <div><label class="block text-sm font-medium mb-2">Estoque Mínimo *</label><input type="number" name="estoque_minimo" value="0" required class="w-full px-4 py-2 border rounded-lg"></div>
            <div><label class="block text-sm font-medium mb-2">Estoque Atual *</label><input type="number" name="estoque_atual" value="0" required class="w-full px-4 py-2 border rounded-lg"></div>
            <div class="md:col-span-2"><label class="block text-sm font-medium mb-2">Descrição</label><textarea name="descricao" rows="3" class="w-full px-4 py-2 border rounded-lg"></textarea></div>
            <div class="md:col-span-2"><label class="block text-sm font-medium mb-2">Imagem</label><input type="file" name="imagem" accept="image/*" class="w-full px-4 py-2 border rounded-lg"></div>
            <div class="md:col-span-2"><label class="flex items-center"><input type="checkbox" name="ativo" value="1" checked class="w-4 h-4"><span class="ml-2">Produto ativo</span></label></div>
        </div></div>
        <div class="flex justify-end space-x-4"><a href="{{ route('admin.produtos.index') }}" class="bg-gray-200 px-6 py-3 rounded-lg">Cancelar</a><button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-lg"><i class="fas fa-save mr-2"></i>Salvar</button></div>
    </form>
</div>
@endsection

