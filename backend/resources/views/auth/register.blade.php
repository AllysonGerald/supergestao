<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Super Gestão</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full">
        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            <!-- Logo/Header -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-full mb-4">
                    <i class="fas fa-user-plus text-2xl text-white"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-900">Criar Conta</h1>
                <p class="text-gray-600 mt-2">Preencha os dados para se cadastrar</p>
            </div>

            <!-- Erros de validação -->
            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-circle text-red-500 mt-0.5 mr-2"></i>
                        <div class="flex-1">
                            @foreach($errors->all() as $error)
                                <p class="text-sm text-red-600">{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Formulário -->
            <form action="{{ route('register.post') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Nome -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Nome Completo
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}"
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('name') border-red-500 @enderror"
                               placeholder="Seu nome completo"
                               required>
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        E-mail
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}"
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('email') border-red-500 @enderror"
                               placeholder="seu@email.com"
                               required>
                    </div>
                </div>

                <!-- Senha -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Senha
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" 
                               id="password" 
                               name="password" 
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('password') border-red-500 @enderror"
                               placeholder="Mínimo 8 caracteres"
                               required>
                    </div>
                </div>

                <!-- Confirmar Senha -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                        Confirmar Senha
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                               placeholder="Digite a senha novamente"
                               required>
                    </div>
                </div>

                <!-- Botão de Cadastro -->
                <button type="submit" 
                        class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-3 px-4 rounded-lg font-medium hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out transform hover:scale-[1.02]">
                    <i class="fas fa-user-plus mr-2"></i>
                    Criar Conta
                </button>
            </form>

            <!-- Link para login -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Já tem uma conta?
                    <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                        Faça login aqui
                    </a>
                </p>
            </div>
        </div>

        <!-- Link para o site -->
        <div class="text-center mt-6">
            <a href="{{ route('site.principal') }}" class="text-white hover:text-gray-200 text-sm">
                <i class="fas fa-arrow-left mr-2"></i>
                Voltar para o site
            </a>
        </div>
    </div>
</body>
</html>

