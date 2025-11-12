<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Exibe o formulário de login
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.login');
    }

    /**
     * Processa o login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'O e-mail é obrigatório',
            'email.email' => 'Digite um e-mail válido',
            'password.required' => 'A senha é obrigatória',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // Verifica se o usuário está ativo
            if (!Auth::user()->active) {
                Auth::logout();
                throw ValidationException::withMessages([
                    'email' => 'Sua conta está inativa. Entre em contato com o administrador.',
                ]);
            }

            return redirect()->intended(route('admin.dashboard'));
        }

        throw ValidationException::withMessages([
            'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ]);
    }

    /**
     * Efetua o logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

