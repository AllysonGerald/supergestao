<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Exception;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Cliente::query();

        // Busca
        if ($request->filled('busca')) {
            $busca = $request->busca;
            $query->where(function ($q) use ($busca): void {
                $q->where('nome', 'like', "%{$busca}%")
                  ->orWhere('email', 'like', "%{$busca}%")
                  ->orWhere('cpf_cnpj', 'like', "%{$busca}%");
            });
        }

        // Filtro por tipo
        if ($request->filled('tipo')) {
            $query->where('tipo', $request->tipo);
        }

        // Filtro por status
        if ($request->filled('ativo')) {
            $query->where('ativo', $request->ativo);
        }

        $clientes = $query->orderBy('nome')->paginate(10);

        return view('admin.clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf_cnpj' => 'required|string|max:18|unique:clientes',
            'tipo' => 'required|in:fisica,juridica',
            'email' => 'required|email|unique:clientes',
            'telefone' => 'required|string|max:20',
            'celular' => 'nullable|string|max:20',
            'cep' => 'required|string|max:9',
            'endereco' => 'required|string|max:255',
            'numero' => 'required|string|max:10',
            'complemento' => 'nullable|string|max:255',
            'bairro' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|max:2',
            'observacoes' => 'nullable|string',
            'ativo' => 'boolean',
        ]);

        Cliente::create($validated);

        return redirect()->route('admin.clientes.index')
            ->with('success', 'Cliente cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        $cliente->load('pedidos');

        return view('admin.clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        return view('admin.clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf_cnpj' => 'required|string|max:18|unique:clientes,cpf_cnpj,'.$cliente->id,
            'tipo' => 'required|in:fisica,juridica',
            'email' => 'required|email|unique:clientes,email,'.$cliente->id,
            'telefone' => 'required|string|max:20',
            'celular' => 'nullable|string|max:20',
            'cep' => 'required|string|max:9',
            'endereco' => 'required|string|max:255',
            'numero' => 'required|string|max:10',
            'complemento' => 'nullable|string|max:255',
            'bairro' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|max:2',
            'observacoes' => 'nullable|string',
            'ativo' => 'boolean',
        ]);

        $cliente->update($validated);

        return redirect()->route('admin.clientes.index')
            ->with('success', 'Cliente atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        try {
            $cliente->delete();

            return redirect()->route('admin.clientes.index')
                ->with('success', 'Cliente excluído com sucesso!');
        } catch (Exception $e) {
            return redirect()->route('admin.clientes.index')
                ->with('error', 'Erro ao excluir cliente. Verifique se não há pedidos vinculados.');
        }
    }
}
