@extends('layouts.site')

@section('title', 'Contato - Super Gestão')

@section('content')

<!-- Header -->
<section class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">
            Entre em Contato
        </h1>
        <p class="text-xl text-blue-100">
            Estamos aqui para ajudar. Envie sua mensagem e retornaremos em breve.
        </p>
    </div>
</section>

<!-- Contact Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Envie sua Mensagem</h2>
                
                <form action="#" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Nome -->
                    <div>
                        <label for="nome" class="block text-sm font-medium text-gray-700 mb-2">
                            Nome Completo *
                        </label>
                        <input type="text" 
                               id="nome" 
                               name="nome" 
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                               placeholder="Seu nome completo">
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            E-mail *
                        </label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                               placeholder="seu@email.com">
                    </div>

                    <!-- Telefone -->
                    <div>
                        <label for="telefone" class="block text-sm font-medium text-gray-700 mb-2">
                            Telefone
                        </label>
                        <input type="tel" 
                               id="telefone" 
                               name="telefone"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                               placeholder="(11) 1234-5678">
                    </div>

                    <!-- Assunto -->
                    <div>
                        <label for="assunto" class="block text-sm font-medium text-gray-700 mb-2">
                            Assunto *
                        </label>
                        <select id="assunto" 
                                name="assunto" 
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                            <option value="">Selecione um assunto</option>
                            <option value="duvida">Dúvida sobre o sistema</option>
                            <option value="suporte">Suporte técnico</option>
                            <option value="comercial">Informações comerciais</option>
                            <option value="sugestao">Sugestão</option>
                            <option value="outro">Outro</option>
                        </select>
                    </div>

                    <!-- Mensagem -->
                    <div>
                        <label for="mensagem" class="block text-sm font-medium text-gray-700 mb-2">
                            Mensagem *
                        </label>
                        <textarea id="mensagem" 
                                  name="mensagem" 
                                  rows="5" 
                                  required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition resize-none"
                                  placeholder="Escreva sua mensagem aqui..."></textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-4 rounded-lg font-semibold hover:from-blue-700 hover:to-indigo-700 transition shadow-lg">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Enviar Mensagem
                    </button>

                    <p class="text-sm text-gray-500 text-center">
                        * Campos obrigatórios
                    </p>
                </form>
            </div>

            <!-- Contact Info -->
            <div class="space-y-6">
                <!-- Info Card -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Informações de Contato</h2>
                    
                    <div class="space-y-6">
                        <!-- Email -->
                        <div class="flex items-start space-x-4">
                            <div class="bg-blue-100 p-3 rounded-lg">
                                <i class="fas fa-envelope text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">E-mail</h3>
                                <p class="text-gray-600">contato@supergestao.com</p>
                                <p class="text-gray-600">suporte@supergestao.com</p>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="flex items-start space-x-4">
                            <div class="bg-green-100 p-3 rounded-lg">
                                <i class="fas fa-phone text-green-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Telefone</h3>
                                <p class="text-gray-600">(11) 1234-5678</p>
                                <p class="text-gray-600">(11) 98765-4321</p>
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="flex items-start space-x-4">
                            <div class="bg-purple-100 p-3 rounded-lg">
                                <i class="fas fa-map-marker-alt text-purple-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Endereço</h3>
                                <p class="text-gray-600">Av. Paulista, 1234</p>
                                <p class="text-gray-600">São Paulo, SP - CEP 01310-100</p>
                            </div>
                        </div>

                        <!-- Horário -->
                        <div class="flex items-start space-x-4">
                            <div class="bg-orange-100 p-3 rounded-lg">
                                <i class="fas fa-clock text-orange-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Horário de Atendimento</h3>
                                <p class="text-gray-600">Segunda a Sexta: 9h às 18h</p>
                                <p class="text-gray-600">Sábado: 9h às 13h</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Social Media -->
                <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl shadow-lg p-8 text-white">
                    <h2 class="text-2xl font-bold mb-6">Redes Sociais</h2>
                    <p class="text-blue-100 mb-6">
                        Siga-nos nas redes sociais e fique por dentro das novidades
                    </p>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <a href="#" class="bg-white/10 backdrop-blur-lg hover:bg-white/20 transition p-4 rounded-lg flex items-center space-x-3">
                            <i class="fab fa-facebook text-2xl"></i>
                            <span class="font-medium">Facebook</span>
                        </a>
                        <a href="#" class="bg-white/10 backdrop-blur-lg hover:bg-white/20 transition p-4 rounded-lg flex items-center space-x-3">
                            <i class="fab fa-instagram text-2xl"></i>
                            <span class="font-medium">Instagram</span>
                        </a>
                        <a href="#" class="bg-white/10 backdrop-blur-lg hover:bg-white/20 transition p-4 rounded-lg flex items-center space-x-3">
                            <i class="fab fa-linkedin text-2xl"></i>
                            <span class="font-medium">LinkedIn</span>
                        </a>
                        <a href="#" class="bg-white/10 backdrop-blur-lg hover:bg-white/20 transition p-4 rounded-lg flex items-center space-x-3">
                            <i class="fab fa-twitter text-2xl"></i>
                            <span class="font-medium">Twitter</span>
                        </a>
                    </div>
                </div>

                <!-- FAQ Link -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Perguntas Frequentes</h3>
                    <p class="text-gray-600 mb-4">
                        Visite nossa central de ajuda para encontrar respostas rápidas
                    </p>
                    <a href="#" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium">
                        Acessar FAQ
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section (Optional) -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gray-200 rounded-2xl overflow-hidden" style="height: 400px;">
            <div class="w-full h-full flex items-center justify-center text-gray-500">
                <div class="text-center">
                    <i class="fas fa-map-marked-alt text-6xl mb-4"></i>
                    <p class="text-lg">Mapa de Localização</p>
                    <p class="text-sm">(Integração com Google Maps)</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
