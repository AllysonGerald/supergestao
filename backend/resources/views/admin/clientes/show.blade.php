@extends('layouts.admin')

@section('title', 'Detalhes do Cliente - Super Gestão')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ $cliente->nome }}</h1>
            <p class="text-gray-600 mt-1">Detalhes do cliente</p>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('admin.clientes.edit', $cliente) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium transition">
                <i class="fas fa-edit mr-2"></i>Editar
            </a>
            <a href="{{ route('admin.clientes.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-lg font-medium transition">
                <i class="fas fa-arrow-left mr-2"></i>Voltar
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Informações Básicas</h2>
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Nome</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $cliente->nome }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Tipo</dt>
                        <dd class="mt-1"><span class="px-2 py-1 text-xs font-medium rounded-full {{ $cliente->tipo == 'fisica' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                            {{ $cliente->tipo == 'fisica' ? 'Pessoa Física' : 'Pessoa Jurídica' }}
                        </span></dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">CPF/CNPJ</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $cliente->cpf_cnpj }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Status</dt>
                        <dd class="mt-1"><span class="px-2 py-1 text-xs font-medium rounded-full {{ $cliente->ativo ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $cliente->ativo ? 'Ativo' : 'Inativo' }}
                        </span></dd>
                    </div>
                </dl>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Contato</h2>
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">E-mail</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $cliente->email }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Telefone</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $cliente->telefone }}</dd>
                    </div>
                    @if($cliente->celular)
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Celular</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $cliente->celular }}</dd>
                    </div>
                    @endif
                </dl>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Endereço</h2>
                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Endereço Completo</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $cliente->endereco }}, {{ $cliente->numero }}
                            @if($cliente->complemento), {{ $cliente->complemento }}@endif<br>
                            {{ $cliente->bairro }} - {{ $cliente->cidade }}/{{ $cliente->estado }}<br>
                            CEP: {{ $cliente->cep }}
                        </dd>
                    </div>
                </dl>
            </div>

            @if($cliente->observacoes)
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Observações</h2>
                <p class="text-sm text-gray-700">{{ $cliente->observacoes }}</p>
            </div>
            @endif
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Estatísticas</h2>
                <div class="space-y-4">
                    <div class="text-center p-4 bg-indigo-50 rounded-lg">
                        <p class="text-3xl font-bold text-indigo-600">{{ $cliente->pedidos->count() }}</p>
                        <p class="text-sm text-gray-600 mt-1">Pedidos Realizados</p>
                    </div>
                    <div class="text-center p-4 bg-green-50 rounded-lg">
                        <p class="text-3xl font-bold text-green-600">R$ {{ number_format($cliente->pedidos->sum('valor_final'), 2, ',', '.') }}</p>
                        <p class="text-sm text-gray-600 mt-1">Total em Pedidos</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Últimos Pedidos</h2>
                @if($cliente->pedidos->count() > 0)
                    <div class="space-y-3">
                        @foreach($cliente->pedidos->take(5) as $pedido)
                            <a href="{{ route('admin.pedidos.show', $pedido) }}" class="block p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition">
                                <p class="font-semibold text-sm text-gray-900">{{ $pedido->numero_pedido }}</p>
                                <p class="text-xs text-gray-600 mt-1">R$ {{ number_format($pedido->valor_final, 2, ',', '.') }}</p>
                                <p class="text-xs text-gray-500">{{ $pedido->created_at->format('d/m/Y') }}</p>
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-gray-500 text-center py-4">Nenhum pedido ainda</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

