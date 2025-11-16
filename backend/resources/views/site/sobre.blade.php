@extends('layouts.site')

@section('title', 'Sobre Nós - Super Gestão')

@section('content')

<!-- Header -->
<section class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">
            Sobre o Super Gestão
        </h1>
        <p class="text-xl text-blue-100">
            Transformando a gestão empresarial através da tecnologia
        </p>
    </div>
</section>

<!-- Nossa História -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                    Nossa História
                </h2>
                <div class="space-y-4 text-gray-600 leading-relaxed">
                    <p>
                        O <strong>Super Gestão</strong> nasceu da necessidade de simplificar e modernizar a gestão empresarial. Percebemos que muitas empresas enfrentavam dificuldades com sistemas complexos e caros.
                    </p>
                    <p>
                        Nossa missão é fornecer uma solução completa, intuitiva e acessível para empresas de todos os tamanhos gerenciarem seus processos de forma eficiente.
                    </p>
                    <p>
                        Desenvolvido com as tecnologias mais modernas e seguindo as melhores práticas de arquitetura de software, o sistema oferece segurança, escalabilidade e facilidade de uso.
                    </p>
                </div>
            </div>
            <div class="bg-gradient-to-br from-blue-100 to-indigo-100 rounded-2xl p-8">
                <div class="grid grid-cols-2 gap-6">
                    <div class="bg-white rounded-xl p-6 text-center shadow-lg">
                        <div class="text-4xl font-bold text-blue-600 mb-2">5+</div>
                        <div class="text-sm text-gray-600">Anos de Experiência</div>
                    </div>
                    <div class="bg-white rounded-xl p-6 text-center shadow-lg">
                        <div class="text-4xl font-bold text-green-600 mb-2">1K+</div>
                        <div class="text-sm text-gray-600">Clientes Ativos</div>
                    </div>
                    <div class="bg-white rounded-xl p-6 text-center shadow-lg">
                        <div class="text-4xl font-bold text-purple-600 mb-2">50K+</div>
                        <div class="text-sm text-gray-600">Pedidos/Mês</div>
                    </div>
                    <div class="bg-white rounded-xl p-6 text-center shadow-lg">
                        <div class="text-4xl font-bold text-orange-600 mb-2">99.9%</div>
                        <div class="text-sm text-gray-600">Disponibilidade</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Missão, Visão e Valores -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Nossos Princípios
            </h2>
            <p class="text-xl text-gray-600">
                O que nos move todos os dias
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <!-- Missão -->
            <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition">
                <div class="bg-gradient-to-r from-blue-600 to-indigo-600 w-16 h-16 rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-bullseye text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Missão</h3>
                <p class="text-gray-600">
                    Fornecer soluções inovadoras de gestão empresarial que simplifiquem processos, aumentem a produtividade e impulsionem o crescimento dos nossos clientes.
                </p>
            </div>

            <!-- Visão -->
            <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition">
                <div class="bg-gradient-to-r from-green-600 to-emerald-600 w-16 h-16 rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-eye text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Visão</h3>
                <p class="text-gray-600">
                    Ser referência nacional em sistemas de gestão empresarial, reconhecidos pela qualidade, inovação e compromisso com o sucesso dos nossos clientes.
                </p>
            </div>

            <!-- Valores -->
            <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition">
                <div class="bg-gradient-to-r from-purple-600 to-violet-600 w-16 h-16 rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-heart text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Valores</h3>
                <ul class="text-gray-600 space-y-2">
                    <li><i class="fas fa-check text-purple-600 mr-2"></i>Inovação constante</li>
                    <li><i class="fas fa-check text-purple-600 mr-2"></i>Foco no cliente</li>
                    <li><i class="fas fa-check text-purple-600 mr-2"></i>Transparência</li>
                    <li><i class="fas fa-check text-purple-600 mr-2"></i>Excelência técnica</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Tecnologia -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div class="order-2 md:order-1">
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 rounded-xl p-6 text-center hover:shadow-lg transition">
                        <i class="fab fa-laravel text-red-600 text-4xl mb-3"></i>
                        <h4 class="font-semibold text-gray-900">Laravel 12</h4>
                        <p class="text-sm text-gray-600">Framework PHP</p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-6 text-center hover:shadow-lg transition">
                        <i class="fab fa-php text-indigo-600 text-4xl mb-3"></i>
                        <h4 class="font-semibold text-gray-900">PHP 8.2+</h4>
                        <p class="text-sm text-gray-600">Backend Moderno</p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-6 text-center hover:shadow-lg transition">
                        <i class="fas fa-database text-blue-600 text-4xl mb-3"></i>
                        <h4 class="font-semibold text-gray-900">MySQL</h4>
                        <p class="text-sm text-gray-600">Banco de Dados</p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-6 text-center hover:shadow-lg transition">
                        <i class="fas fa-layer-group text-green-600 text-4xl mb-3"></i>
                        <h4 class="font-semibold text-gray-900">Clean Code</h4>
                        <p class="text-sm text-gray-600">Arquitetura</p>
                    </div>
                </div>
            </div>
            <div class="order-1 md:order-2">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                    Tecnologia de Ponta
                </h2>
                <div class="space-y-4 text-gray-600">
                    <p>
                        Utilizamos as tecnologias mais modernas e confiáveis do mercado para garantir um sistema robusto, seguro e escalável.
                    </p>
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3">
                            <div class="bg-blue-100 p-2 rounded">
                                <i class="fas fa-shield-alt text-blue-600"></i>
                            </div>
                            <span><strong>Segurança:</strong> Criptografia de dados e autenticação robusta</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="bg-green-100 p-2 rounded">
                                <i class="fas fa-bolt text-green-600"></i>
                            </div>
                            <span><strong>Performance:</strong> Cache inteligente e otimizações</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="bg-purple-100 p-2 rounded">
                                <i class="fas fa-code text-purple-600"></i>
                            </div>
                            <span><strong>Código Limpo:</strong> Arquitetura SOLID e Clean Architecture</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="bg-orange-100 p-2 rounded">
                                <i class="fas fa-sync text-orange-600"></i>
                            </div>
                            <span><strong>Atualizações:</strong> Melhorias contínuas e novos recursos</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Diferenciais -->
<section class="py-20 bg-gradient-to-r from-blue-600 to-indigo-700 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">
                Nossos Diferenciais
            </h2>
            <p class="text-xl text-blue-100">
                Por que empresas escolhem o Super Gestão
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="bg-white/10 backdrop-blur-lg w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-mobile-alt text-4xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Responsivo</h3>
                <p class="text-blue-100">Funciona em qualquer dispositivo</p>
            </div>

            <div class="text-center">
                <div class="bg-white/10 backdrop-blur-lg w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-cloud text-4xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Cloud</h3>
                <p class="text-blue-100">Acesse de qualquer lugar</p>
            </div>

            <div class="text-center">
                <div class="bg-white/10 backdrop-blur-lg w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-lock text-4xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Seguro</h3>
                <p class="text-blue-100">Dados protegidos e criptografados</p>
            </div>

            <div class="text-center">
                <div class="bg-white/10 backdrop-blur-lg w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-headset text-4xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Suporte</h3>
                <p class="text-blue-100">Equipe sempre disponível</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
            Faça Parte Dessa História
        </h2>
        <p class="text-xl text-gray-600 mb-8">
            Junte-se a milhares de empresas que já transformaram sua gestão
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('register') }}" 
               class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-8 py-4 rounded-lg font-semibold hover:from-blue-700 hover:to-indigo-700 transition shadow-lg">
                Começar Agora
            </a>
            <a href="{{ route('site.contato') }}" 
               class="border-2 border-blue-600 text-blue-600 px-8 py-4 rounded-lg font-semibold hover:bg-blue-50 transition">
                Falar com Especialista
            </a>
        </div>
    </div>
</section>

@endsection
