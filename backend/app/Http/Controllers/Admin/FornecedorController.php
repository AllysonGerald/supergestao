<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fornecedor;
use Exception;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Fornecedor::query();

        // Busca
        if ($request->filled('busca')) {
            $busca = $request->busca;
            $query->where(function ($q) use ($busca): void {
                $q->where('nome', 'like', "%{$busca}%")
                  ->orWhere('razao_social', 'like', "%{$busca}%")
                  ->orWhere('email', 'like', "%{$busca}%")
                  ->orWhere('cnpj', 'like', "%{$busca}%");
            });
        }

        // Filtro por status
        if ($request->filled('ativo')) {
            $query->where('ativo', $request->ativo);
        }

        $fornecedores = $query->orderBy('nome')->paginate(10);

        return view('admin.fornecedores.index', compact('fornecedores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.fornecedores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'cnpj' => 'required|string|max:18|unique:fornecedores',
            'razao_social' => 'required|string|max:255',
            'email' => 'required|email|unique:fornecedores',
            'telefone' => 'required|string|max:20',
            'celular' => 'nullable|string|max:20',
            'cep' => 'required|string|max:9',
            'endereco' => 'required|string|max:255',
            'numero' => 'required|string|max:10',
            'complemento' => 'nullable|string|max:255',
            'bairro' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|max:2',
            'contato_nome' => 'nullable|string|max:255',
            'observacoes' => 'nullable|string',
            'ativo' => 'boolean',
        ]);

        Fornecedor::create($validated);

        return redirect()->route('admin.fornecedores.index')
            ->with('success', 'Fornecedor cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Fornecedor $fornecedor)
    {
        $fornecedor->load('produtos');

        return view('admin.fornecedores.show', compact('fornecedor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fornecedor $fornecedor)
    {
        return view('admin.fornecedores.edit', compact('fornecedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fornecedor $fornecedor)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'cnpj' => 'required|string|max:18|unique:fornecedores,cnpj,'.$fornecedor->id,
            'razao_social' => 'required|string|max:255',
            'email' => 'required|email|unique:fornecedores,email,'.$fornecedor->id,
            'telefone' => 'required|string|max:20',
            'celular' => 'nullable|string|max:20',
            'cep' => 'required|string|max:9',
            'endereco' => 'required|string|max:255',
            'numero' => 'required|string|max:10',
            'complemento' => 'nullable|string|max:255',
            'bairro' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|max:2',
            'contato_nome' => 'nullable|string|max:255',
            'observacoes' => 'nullable|string',
            'ativo' => 'boolean',
        ]);

        $fornecedor->update($validated);

        return redirect()->route('admin.fornecedores.index')
            ->with('success', 'Fornecedor atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fornecedor $fornecedor)
    {
        try {
            $fornecedor->delete();

            return redirect()->route('admin.fornecedores.index')
                ->with('success', 'Fornecedor excluído com sucesso!');
        } catch (Exception $e) {
            return redirect()->route('admin.fornecedores.index')
                ->with('error', 'Erro ao excluir fornecedor. Verifique se não há produtos vinculados.');
        }
    }
}
