@extends('layouts.admin')

@section('title', 'Clientes - Super Gestão')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Clientes</h1>
            <p class="text-gray-600 mt-1">Gerencie os clientes do sistema</p>
        </div>
        <a href="{{ route('admin.clientes.create') }}" 
           class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium transition flex items-center">
            <i class="fas fa-plus mr-2"></i>
            Novo Cliente
        </a>
    </div>

    <!-- Filtros e Busca -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <form action="{{ route('admin.clientes.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="md:col-span-2">
                <input type="text" 
                       name="busca" 
                       value="{{ request('busca') }}"
                       placeholder="Buscar por nome, email ou CPF/CNPJ..."
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            </div>
            <div>
                <select name="tipo" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <option value="">Todos os tipos</option>
                    <option value="fisica" {{ request('tipo') == 'fisica' ? 'selected' : '' }}>Pessoa Física</option>
                    <option value="juridica" {{ request('tipo') == 'juridica' ? 'selected' : '' }}>Pessoa Jurídica</option>
                </select>
            </div>
            <div class="flex space-x-2">
                <button type="submit" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium transition">
                    <i class="fas fa-search mr-2"></i>Buscar
                </button>
                <a href="{{ route('admin.clientes.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg font-medium transition">
                    <i class="fas fa-times"></i>
                </a>
            </div>
        </form>
    </div>

    <!-- Tabela -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        @if($clientes->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cliente</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CPF/CNPJ</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contato</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cidade</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($clientes as $cliente)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 font-semibold">
                                            {{ substr($cliente->nome, 0, 1) }}
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $cliente->nome }}</div>
                                            <div class="text-sm text-gray-500">{{ $cliente->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full {{ $cliente->tipo == 'fisica' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                        {{ $cliente->tipo == 'fisica' ? 'PF' : 'PJ' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $cliente->cpf_cnpj }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $cliente->telefone }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $cliente->cidade }} - {{ $cliente->estado }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full {{ $cliente->ativo ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $cliente->ativo ? 'Ativo' : 'Inativo' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                    <a href="{{ route('admin.clientes.show', $cliente) }}" class="text-blue-600 hover:text-blue-900" title="Visualizar">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.clientes.edit', $cliente) }}" class="text-indigo-600 hover:text-indigo-900" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.clientes.destroy', $cliente) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja excluir este cliente?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" title="Excluir">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Paginação -->
            <div class="bg-gray-50 px-6 py-4">
                {{ $clientes->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <i class="fas fa-users text-6xl text-gray-300 mb-4"></i>
                <p class="text-gray-500 text-lg">Nenhum cliente encontrado</p>
                <a href="{{ route('admin.clientes.create') }}" class="mt-4 inline-block text-indigo-600 hover:text-indigo-700 font-medium">
                    Cadastrar primeiro cliente
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

