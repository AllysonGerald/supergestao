@extends('layouts.admin')
@section('content')
<div class="space-y-6">
    <div class="flex justify-between"><h1 class="text-3xl font-bold">{{ $user->name }}</h1><div class="flex space-x-2"><a href="{{ route('admin.users.edit', $user) }}" class="bg-indigo-600 text-white px-6 py-3 rounded-lg"><i class="fas fa-edit mr-2"></i>Editar</a><a href="{{ route('admin.users.index') }}" class="bg-gray-200 px-6 py-3 rounded-lg"><i class="fas fa-arrow-left mr-2"></i>Voltar</a></div></div>
    <div class="grid md:grid-cols-3 gap-6">
        <div class="md:col-span-2 space-y-6">
            <div class="bg-white rounded-xl shadow-lg p-6"><h2 class="text-xl font-bold mb-6">Informações do Usuário</h2><dl class="grid md:grid-cols-2 gap-4">
                <div><dt class="text-sm font-medium text-gray-500">Nome</dt><dd class="mt-1 text-sm text-gray-900">{{ $user->name }}</dd></div>
                <div><dt class="text-sm font-medium text-gray-500">E-mail</dt><dd class="mt-1 text-sm text-gray-900">{{ $user->email }}</dd></div>
                <div><dt class="text-sm font-medium text-gray-500">Perfil</dt><dd class="mt-1"><span class="px-2 py-1 text-xs font-medium rounded-full {{ $user->role == 'admin' ? 'bg-purple-100 text-purple-800' : '' }} {{ $user->role == 'manager' ? 'bg-blue-100 text-blue-800' : '' }} {{ $user->role == 'user' ? 'bg-gray-100 text-gray-800' : '' }}">{{ $user->role == 'admin' ? 'Administrador' : ($user->role == 'manager' ? 'Gerente' : 'Usuário') }}</span></dd></div>
                <div><dt class="text-sm font-medium text-gray-500">Status</dt><dd class="mt-1"><span class="px-2 py-1 text-xs font-medium rounded-full {{ $user->active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">{{ $user->active ? 'Ativo' : 'Inativo' }}</span></dd></div>
                <div><dt class="text-sm font-medium text-gray-500">Cadastrado em</dt><dd class="mt-1 text-sm text-gray-900">{{ $user->created_at->format('d/m/Y H:i') }}</dd></div>
                <div><dt class="text-sm font-medium text-gray-500">Última atualização</dt><dd class="mt-1 text-sm text-gray-900">{{ $user->updated_at->format('d/m/Y H:i') }}</dd></div>
            </dl></div>
        </div>
        <div class="space-y-6">
            <div class="bg-white rounded-xl shadow-lg p-6"><h2 class="text-xl font-bold mb-6">Estatísticas</h2>
                <div class="text-center p-4 bg-indigo-50 rounded-lg"><p class="text-3xl font-bold text-indigo-600">{{ $user->pedidos->count() }}</p><p class="text-sm text-gray-600 mt-1">Pedidos Criados</p></div>
            </div>
        </div>
    </div>
</div>
@endsection

