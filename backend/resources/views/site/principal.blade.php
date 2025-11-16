@extends('layouts.site')

@section('title', 'Super Gestão - Sistema de Gestão Empresarial')

@section('content')

<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div>
                <h1 class="text-4xl md:text-5xl font-bold mb-6">
                    Gerencie Seu Negócio de Forma Inteligente
                </h1>
                <p class="text-xl mb-8 text-blue-100">
                    Sistema completo de gestão empresarial para controlar clientes, fornecedores, produtos e pedidos em um único lugar.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('register') }}" 
                       class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition text-center">
                        Começar Agora
                    </a>
                    <a href="{{ route('site.contato') }}" 
                       class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition text-center">
                        Fale Conosco
                    </a>
                </div>
            </div>
            <div class="hidden md:block">
                <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-8 border border-white/20">
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <div class="bg-white/20 p-3 rounded-lg">
                                <i class="fas fa-chart-line text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold">Dashboard Completo</h3>
                                <p class="text-sm text-blue-100">Métricas em tempo real</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="bg-white/20 p-3 rounded-lg">
                                <i class="fas fa-users text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold">Gestão de Clientes</h3>
                                <p class="text-sm text-blue-100">Cadastro PF e PJ</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="bg-white/20 p-3 rounded-lg">
                                <i class="fas fa-box text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold">Controle de Estoque</h3>
                                <p class="text-sm text-blue-100">Produtos e alertas</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Funcionalidades Completas
            </h2>
            <p class="text-xl text-gray-600">
                Tudo que você precisa para gerenciar sua empresa
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Feature 1 -->
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-6 rounded-xl hover:shadow-lg transition">
                <div class="bg-gradient-to-r from-blue-600 to-indigo-600 w-14 h-14 rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-users text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Clientes</h3>
                <p class="text-gray-600">
                    Cadastro completo de pessoas físicas e jurídicas com histórico de pedidos
                </p>
            </div>

            <!-- Feature 2 -->
            <div class="bg-gradient-to-br from-green-50 to-emerald-50 p-6 rounded-xl hover:shadow-lg transition">
                <div class="bg-gradient-to-r from-green-600 to-emerald-600 w-14 h-14 rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-truck text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Fornecedores</h3>
                <p class="text-gray-600">
                    Gestão de fornecedores com produtos vinculados e dados completos
                </p>
            </div>

            <!-- Feature 3 -->
            <div class="bg-gradient-to-br from-purple-50 to-violet-50 p-6 rounded-xl hover:shadow-lg transition">
                <div class="bg-gradient-to-r from-purple-600 to-violet-600 w-14 h-14 rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-box text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Produtos</h3>
                <p class="text-gray-600">
                    Controle de estoque, preços, categorias e alertas de estoque baixo
                </p>
            </div>

            <!-- Feature 4 -->
            <div class="bg-gradient-to-br from-orange-50 to-amber-50 p-6 rounded-xl hover:shadow-lg transition">
                <div class="bg-gradient-to-r from-orange-600 to-amber-600 w-14 h-14 rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-shopping-cart text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Pedidos</h3>
                <p class="text-gray-600">
                    Criação de pedidos com múltiplos itens e controle de status
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-20 bg-gradient-to-r from-blue-600 to-indigo-700 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="text-5xl font-bold mb-2">1000+</div>
                <div class="text-blue-100">Empresas Ativas</div>
            </div>
            <div>
                <div class="text-5xl font-bold mb-2">50K+</div>
                <div class="text-blue-100">Pedidos Processados</div>
            </div>
            <div>
                <div class="text-5xl font-bold mb-2">99.9%</div>
                <div class="text-blue-100">Uptime</div>
            </div>
            <div>
                <div class="text-5xl font-bold mb-2">24/7</div>
                <div class="text-blue-100">Suporte</div>
            </div>
        </div>
    </div>
</section>

<!-- Benefits Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                    Por que escolher o Super Gestão?
                </h2>
                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <div class="bg-blue-100 p-2 rounded-lg mt-1">
                            <i class="fas fa-check text-blue-600"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg text-gray-900">Interface Intuitiva</h3>
                            <p class="text-gray-600">Design moderno e fácil de usar, sem necessidade de treinamento</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="bg-blue-100 p-2 rounded-lg mt-1">
                            <i class="fas fa-check text-blue-600"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg text-gray-900">Segurança Garantida</h3>
                            <p class="text-gray-600">Dados protegidos com criptografia e backups automáticos</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="bg-blue-100 p-2 rounded-lg mt-1">
                            <i class="fas fa-check text-blue-600"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg text-gray-900">Relatórios Completos</h3>
                            <p class="text-gray-600">Métricas e estatísticas em tempo real para tomada de decisão</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="bg-blue-100 p-2 rounded-lg mt-1">
                            <i class="fas fa-check text-blue-600"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg text-gray-900">Suporte Dedicado</h3>
                            <p class="text-gray-600">Equipe pronta para ajudar quando você precisar</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gradient-to-br from-blue-100 to-indigo-100 rounded-2xl p-8">
                <div class="bg-white rounded-xl p-6 shadow-lg">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-semibold text-gray-900">Dashboard</h3>
                        <span class="text-xs text-gray-500">Em Tempo Real</span>
                    </div>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Pedidos Hoje</span>
                            <span class="font-semibold text-green-600">+24</span>
                        </div>
                        <div class="bg-gray-200 rounded-full h-2">
                            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 h-2 rounded-full" style="width: 75%"></div>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Estoque</span>
                            <span class="font-semibold text-blue-600">89%</span>
                        </div>
                        <div class="bg-gray-200 rounded-full h-2">
                            <div class="bg-gradient-to-r from-green-500 to-emerald-500 h-2 rounded-full" style="width: 89%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
            Pronto para transformar sua gestão?
        </h2>
        <p class="text-xl text-gray-600 mb-8">
            Comece agora mesmo e veja a diferença em poucos minutos
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('register') }}" 
               class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-8 py-4 rounded-lg font-semibold hover:from-blue-700 hover:to-indigo-700 transition text-center shadow-lg">
                Criar Conta Grátis
            </a>
            <a href="{{ route('site.contato') }}" 
               class="border-2 border-blue-600 text-blue-600 px-8 py-4 rounded-lg font-semibold hover:bg-blue-50 transition text-center">
                Falar com Consultor
            </a>
        </div>
    </div>
</section>

@endsection
