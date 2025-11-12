@extends('layouts.admin')
@section('content')
<div class="space-y-6">
    <div class="flex justify-between"><h1 class="text-3xl font-bold">Novo Usuário</h1><a href="{{ route('admin.users.index') }}" class="bg-gray-200 px-6 py-3 rounded-lg"><i class="fas fa-arrow-left mr-2"></i>Voltar</a></div>
    <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">@csrf
        <div class="bg-white rounded-xl shadow-lg p-6"><h2 class="text-xl font-bold mb-6">Dados do Usuário</h2><div class="grid md:grid-cols-2 gap-6">
            <div class="md:col-span-2"><label class="block text-sm font-medium mb-2">Nome Completo *</label><input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-2 border rounded-lg @error('name') border-red-500 @enderror">@error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror</div>
            <div><label class="block text-sm font-medium mb-2">E-mail *</label><input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-2 border rounded-lg @error('email') border-red-500 @enderror">@error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror</div>
            <div><label class="block text-sm font-medium mb-2">Perfil *</label><select name="role" required class="w-full px-4 py-2 border rounded-lg"><option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Usuário</option><option value="manager" {{ old('role') == 'manager' ? 'selected' : '' }}>Gerente</option><option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrador</option></select></div>
            <div><label class="block text-sm font-medium mb-2">Senha *</label><input type="password" name="password" required class="w-full px-4 py-2 border rounded-lg @error('password') border-red-500 @enderror">@error('password')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror</div>
            <div><label class="block text-sm font-medium mb-2">Confirmar Senha *</label><input type="password" name="password_confirmation" required class="w-full px-4 py-2 border rounded-lg"></div>
            <div class="md:col-span-2"><label class="flex items-center"><input type="checkbox" name="active" value="1" checked class="w-4 h-4"><span class="ml-2">Usuário ativo</span></label></div>
        </div></div>
        <div class="flex justify-end space-x-4"><a href="{{ route('admin.users.index') }}" class="bg-gray-200 px-6 py-3 rounded-lg">Cancelar</a><button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-lg"><i class="fas fa-save mr-2"></i>Salvar Usuário</button></div>
    </form>
</div>
@endsection

