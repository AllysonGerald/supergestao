<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Super Gestão - Sistema completo de gestão empresarial">
    <title>@yield('title', 'Super Gestão - Sistema de Gestão Empresarial')</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50 antialiased">
    
    <!-- Navbar -->
    <nav class="bg-white shadow-lg fixed w-full z-50" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('site.principal') }}" class="flex items-center space-x-2">
                        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-2 rounded-lg">
                            <i class="fas fa-chart-line text-white text-xl"></i>
                        </div>
                        <span class="text-xl font-bold text-gray-800">Super Gestão</span>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('site.principal') }}" 
                       class="text-gray-700 hover:text-blue-600 font-medium transition {{ request()->routeIs('site.principal') ? 'text-blue-600' : '' }}">
                        Início
                    </a>
                    <a href="{{ route('site.sobre') }}" 
                       class="text-gray-700 hover:text-blue-600 font-medium transition {{ request()->routeIs('site.sobre') ? 'text-blue-600' : '' }}">
                        Sobre
                    </a>
                    <a href="{{ route('site.contato') }}" 
                       class="text-gray-700 hover:text-blue-600 font-medium transition {{ request()->routeIs('site.contato') ? 'text-blue-600' : '' }}">
                        Contato
                    </a>
                    @auth
                        <a href="{{ route('admin.dashboard') }}" 
                           class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-2 rounded-lg hover:from-blue-700 hover:to-indigo-700 transition">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" 
                           class="text-gray-700 hover:text-blue-600 font-medium transition">
                            Entrar
                        </a>
                        <a href="{{ route('register') }}" 
                           class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-2 rounded-lg hover:from-blue-700 hover:to-indigo-700 transition">
                            Cadastrar
                        </a>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button @click="open = !open" class="text-gray-700 hover:text-blue-600 focus:outline-none">
                        <i class="fas text-2xl" :class="open ? 'fa-times' : 'fa-bars'"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="open" x-cloak 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="md:hidden bg-white border-t">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('site.principal') }}" 
                   class="block px-3 py-2 rounded-md text-gray-700 hover:bg-blue-50 hover:text-blue-600 font-medium {{ request()->routeIs('site.principal') ? 'bg-blue-50 text-blue-600' : '' }}">
                    Início
                </a>
                <a href="{{ route('site.sobre') }}" 
                   class="block px-3 py-2 rounded-md text-gray-700 hover:bg-blue-50 hover:text-blue-600 font-medium {{ request()->routeIs('site.sobre') ? 'bg-blue-50 text-blue-600' : '' }}">
                    Sobre
                </a>
                <a href="{{ route('site.contato') }}" 
                   class="block px-3 py-2 rounded-md text-gray-700 hover:bg-blue-50 hover:text-blue-600 font-medium {{ request()->routeIs('site.contato') ? 'bg-blue-50 text-blue-600' : '' }}">
                    Contato
                </a>
                @auth
                    <a href="{{ route('admin.dashboard') }}" 
                       class="block px-3 py-2 rounded-md bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-center">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" 
                       class="block px-3 py-2 rounded-md text-gray-700 hover:bg-blue-50 hover:text-blue-600 font-medium">
                        Entrar
                    </a>
                    <a href="{{ route('register') }}" 
                       class="block px-3 py-2 rounded-md bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-center">
                        Cadastrar
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-16">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Sobre -->
                <div>
                    <h3 class="text-lg font-bold mb-4">Super Gestão</h3>
                    <p class="text-gray-400 text-sm">
                        Sistema completo de gestão empresarial para otimizar seus processos e aumentar a produtividade.
                    </p>
                </div>

                <!-- Links Rápidos -->
                <div>
                    <h3 class="text-lg font-bold mb-4">Links Rápidos</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('site.principal') }}" class="text-gray-400 hover:text-white transition">Início</a></li>
                        <li><a href="{{ route('site.sobre') }}" class="text-gray-400 hover:text-white transition">Sobre</a></li>
                        <li><a href="{{ route('site.contato') }}" class="text-gray-400 hover:text-white transition">Contato</a></li>
                        <li><a href="{{ route('login') }}" class="text-gray-400 hover:text-white transition">Entrar</a></li>
                    </ul>
                </div>

                <!-- Módulos -->
                <div>
                    <h3 class="text-lg font-bold mb-4">Módulos</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><i class="fas fa-check text-blue-500"></i> Clientes</li>
                        <li><i class="fas fa-check text-blue-500"></i> Fornecedores</li>
                        <li><i class="fas fa-check text-blue-500"></i> Produtos</li>
                        <li><i class="fas fa-check text-blue-500"></i> Pedidos</li>
                    </ul>
                </div>

                <!-- Contato -->
                <div>
                    <h3 class="text-lg font-bold mb-4">Contato</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><i class="fas fa-envelope"></i> contato@supergestao.com</li>
                        <li><i class="fas fa-phone"></i> (11) 1234-5678</li>
                        <li><i class="fas fa-map-marker-alt"></i> São Paulo, SP</li>
                    </ul>
                    <div class="flex space-x-4 mt-4">
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-facebook text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-linkedin text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm text-gray-400">
                <p>&copy; {{ date('Y') }} Super Gestão. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>

