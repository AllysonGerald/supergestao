@extends('layouts.admin')
@section('content')
<div class="space-y-6">
    <div class="flex justify-between"><div><h1 class="text-3xl font-bold">Usuários</h1><p class="text-gray-600 mt-1">Gerencie os usuários do sistema</p></div><a href="{{ route('admin.users.create') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-lg"><i class="fas fa-plus mr-2"></i>Novo Usuário</a></div>
    <div class="bg-white rounded-xl shadow-lg p-6"><form action="{{ route('admin.users.index') }}" method="GET" class="grid md:grid-cols-4 gap-4">
        <div class="md:col-span-2"><input type="text" name="busca" value="{{ request('busca') }}" placeholder="Buscar por nome ou email..." class="w-full px-4 py-2 border rounded-lg"></div>
        <div><select name="role" class="w-full px-4 py-2 border rounded-lg"><option value="">Todos perfis</option><option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option><option value="manager" {{ request('role') == 'manager' ? 'selected' : '' }}>Gerente</option><option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>Usuário</option></select></div>
        <div class="flex space-x-2"><button type="submit" class="flex-1 bg-indigo-600 text-white px-4 py-2 rounded-lg"><i class="fas fa-search mr-2"></i>Buscar</button><a href="{{ route('admin.users.index') }}" class="bg-gray-200 px-4 py-2 rounded-lg"><i class="fas fa-times"></i></a></div>
    </form></div>
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        @if($users->count() > 0)
        <div class="overflow-x-auto"><table class="min-w-full divide-y"><thead class="bg-gray-50"><tr><th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Usuário</th><th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Perfil</th><th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th><th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Cadastro</th><th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Ações</th></tr></thead><tbody class="divide-y">
            @foreach($users as $user)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4"><div class="flex items-center"><div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 font-semibold">{{ substr($user->name, 0, 1) }}</div><div class="ml-4"><div class="font-medium text-gray-900">{{ $user->name }}</div><div class="text-sm text-gray-500">{{ $user->email }}</div></div></div></td>
                <td class="px-6 py-4"><span class="px-2 py-1 text-xs font-medium rounded-full {{ $user->role == 'admin' ? 'bg-purple-100 text-purple-800' : '' }} {{ $user->role == 'manager' ? 'bg-blue-100 text-blue-800' : '' }} {{ $user->role == 'user' ? 'bg-gray-100 text-gray-800' : '' }}">{{ $user->role == 'admin' ? 'Admin' : ($user->role == 'manager' ? 'Gerente' : 'Usuário') }}</span></td>
                <td class="px-6 py-4"><span class="px-2 py-1 text-xs font-medium rounded-full {{ $user->active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">{{ $user->active ? 'Ativo' : 'Inativo' }}</span></td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $user->created_at->format('d/m/Y') }}</td>
                <td class="px-6 py-4 text-right space-x-2"><a href="{{ route('admin.users.show', $user) }}" class="text-blue-600"><i class="fas fa-eye"></i></a><a href="{{ route('admin.users.edit', $user) }}" class="text-indigo-600"><i class="fas fa-edit"></i></a>@if($user->id != auth()->id())<form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza?')">@csrf @method('DELETE')<button type="submit" class="text-red-600"><i class="fas fa-trash"></i></button></form>@endif</td>
            </tr>
            @endforeach
        </tbody></table></div>
        <div class="bg-gray-50 px-6 py-4">{{ $users->links() }}</div>
        @else
        <div class="text-center py-12"><i class="fas fa-users text-6xl text-gray-300 mb-4"></i><p class="text-gray-500 text-lg">Nenhum usuário encontrado</p></div>
        @endif
    </div>
</div>
@endsection

