<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\ClienteController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FornecedorController;
use App\Http\Controllers\Admin\PedidoController;
use App\Http\Controllers\Admin\ProdutoController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Site\ContatoController;
use App\Http\Controllers\Site\PrincipalController;
use App\Http\Controllers\Site\SobreController;
use Illuminate\Support\Facades\Route;

// Rotas do Site
Route::get('/', [PrincipalController::class, 'principal'])->name('site.principal');
Route::get('/contato', [ContatoController::class, 'contato'])->name('site.contato');
Route::get('/sobre-nos', [SobreController::class, 'sobre'])->name('site.sobre');

// Rotas de Autenticação
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

// Rotas Administrativas (Protegidas por autenticação)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function (): void {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Clientes
    Route::resource('clientes', ClienteController::class);

    // Fornecedores
    Route::resource('fornecedores', FornecedorController::class);

    // Produtos
    Route::resource('produtos', ProdutoController::class);

    // Pedidos
    Route::resource('pedidos', PedidoController::class);
    Route::get('pedidos/produto/{id}', [PedidoController::class, 'buscarProduto'])->name('pedidos.buscar-produto');

    // Usuários (Apenas para administradores)
    Route::middleware(['check.admin'])->group(function (): void {
        Route::resource('users', UserController::class);
    });
});
