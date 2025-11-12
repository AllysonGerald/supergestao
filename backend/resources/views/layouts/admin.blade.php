<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Super Gestão')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        [x-cloak] { display: none !important; }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-100" x-data="{ sidebarOpen: true }">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
               class="fixed inset-y-0 left-0 z-50 w-64 bg-gradient-to-b from-indigo-800 to-indigo-900 text-white transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0">
            <div class="flex items-center justify-between h-16 px-6 bg-indigo-900/50">
                <h1 class="text-xl font-bold">Super Gestão</h1>
                <button @click="sidebarOpen = false" class="lg:hidden">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <nav class="px-4 py-6 space-y-2">
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center px-4 py-3 rounded-lg hover:bg-indigo-700 transition {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-700' : '' }}">
                    <i class="fas fa-chart-line w-5"></i>
                    <span class="ml-3">Dashboard</span>
                </a>
                
                <div class="pt-4 pb-2 text-xs font-semibold text-indigo-300 uppercase">Cadastros</div>
                
                <a href="{{ route('admin.clientes.index') }}" 
                   class="flex items-center px-4 py-3 rounded-lg hover:bg-indigo-700 transition {{ request()->routeIs('admin.clientes.*') ? 'bg-indigo-700' : '' }}">
                    <i class="fas fa-users w-5"></i>
                    <span class="ml-3">Clientes</span>
                </a>
                
                <a href="{{ route('admin.fornecedores.index') }}" 
                   class="flex items-center px-4 py-3 rounded-lg hover:bg-indigo-700 transition {{ request()->routeIs('admin.fornecedores.*') ? 'bg-indigo-700' : '' }}">
                    <i class="fas fa-truck w-5"></i>
                    <span class="ml-3">Fornecedores</span>
                </a>
                
                <a href="{{ route('admin.produtos.index') }}" 
                   class="flex items-center px-4 py-3 rounded-lg hover:bg-indigo-700 transition {{ request()->routeIs('admin.produtos.*') ? 'bg-indigo-700' : '' }}">
                    <i class="fas fa-box w-5"></i>
                    <span class="ml-3">Produtos</span>
                </a>
                
                <div class="pt-4 pb-2 text-xs font-semibold text-indigo-300 uppercase">Operações</div>
                
                <a href="{{ route('admin.pedidos.index') }}" 
                   class="flex items-center px-4 py-3 rounded-lg hover:bg-indigo-700 transition {{ request()->routeIs('admin.pedidos.*') ? 'bg-indigo-700' : '' }}">
                    <i class="fas fa-shopping-cart w-5"></i>
                    <span class="ml-3">Pedidos</span>
                </a>
                
                @if(auth()->user()->isAdmin())
                <div class="pt-4 pb-2 text-xs font-semibold text-indigo-300 uppercase">Administração</div>
                
                <a href="{{ route('admin.users.index') }}" 
                   class="flex items-center px-4 py-3 rounded-lg hover:bg-indigo-700 transition {{ request()->routeIs('admin.users.*') ? 'bg-indigo-700' : '' }}">
                    <i class="fas fa-user-shield w-5"></i>
                    <span class="ml-3">Usuários</span>
                </a>
                @endif
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-sm z-10">
                <div class="flex items-center justify-between h-16 px-6">
                    <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 lg:hidden">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    
                    <div class="flex items-center space-x-4 ml-auto">
                        <!-- Notificações -->
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="relative p-2 text-gray-600 hover:text-gray-900">
                                <i class="fas fa-bell text-xl"></i>
                                <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                            </button>
                        </div>
                        
                        <!-- User Menu -->
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="flex items-center space-x-3 focus:outline-none">
                                <div class="w-8 h-8 bg-indigo-600 rounded-full flex items-center justify-center text-white font-semibold">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                                <span class="hidden md:block text-sm font-medium text-gray-700">{{ auth()->user()->name }}</span>
                                <i class="fas fa-chevron-down text-xs text-gray-500"></i>
                            </button>
                            
                            <div x-show="open" 
                                 @click.away="open = false"
                                 x-cloak
                                 class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50">
                                <div class="px-4 py-2 border-b">
                                    <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                                </div>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-user w-5"></i> Meu Perfil
                                </a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-cog w-5"></i> Configurações
                                </a>
                                <hr class="my-2">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                        <i class="fas fa-sign-out-alt w-5"></i> Sair
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-6">
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg flex items-center justify-between" x-data="{ show: true }" x-show="show">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                        <button @click="show = false" class="text-green-700 hover:text-green-900">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg flex items-center justify-between" x-data="{ show: true }" x-show="show">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            <span>{{ session('error') }}</span>
                        </div>
                        <button @click="show = false" class="text-red-700 hover:text-red-900">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>

