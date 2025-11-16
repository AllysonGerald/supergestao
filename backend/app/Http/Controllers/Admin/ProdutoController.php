<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fornecedor;
use App\Models\Produto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Produto::with('fornecedor');

        // Busca
        if ($request->filled('busca')) {
            $busca = $request->busca;
            $query->where(function ($q) use ($busca): void {
                $q->where('nome', 'like', "%{$busca}%")
                  ->orWhere('codigo_sku', 'like', "%{$busca}%")
                  ->orWhere('categoria', 'like', "%{$busca}%");
            });
        }

        // Filtro por categoria
        if ($request->filled('categoria')) {
            $query->where('categoria', $request->categoria);
        }

        // Filtro por status
        if ($request->filled('ativo')) {
            $query->where('ativo', $request->ativo);
        }

        // Filtro por estoque baixo
        if ($request->filled('estoque_baixo') && '1' == $request->estoque_baixo) {
            $query->whereColumn('estoque_atual', '<=', 'estoque_minimo');
        }

        $produtos = $query->orderBy('nome')->paginate(10);
        $categorias = Produto::distinct()->pluck('categoria')->filter();

        return view('admin.produtos.index', compact('produtos', 'categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fornecedores = Fornecedor::where('ativo', true)->orderBy('nome')->get();

        return view('admin.produtos.create', compact('fornecedores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'codigo_sku' => 'required|string|max:255|unique:produtos',
            'descricao' => 'nullable|string',
            'fornecedor_id' => 'nullable|exists:fornecedores,id',
            'preco_custo' => 'required|numeric|min:0',
            'preco_venda' => 'required|numeric|min:0',
            'estoque_minimo' => 'required|integer|min:0',
            'estoque_atual' => 'required|integer|min:0',
            'unidade_medida' => 'required|string|max:10',
            'categoria' => 'nullable|string|max:255',
            'imagem' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'ativo' => 'boolean',
        ]);

        // Upload da imagem
        if ($request->hasFile('imagem')) {
            $validated['imagem'] = $request->file('imagem')->store('produtos', 'public');
        }

        Produto::create($validated);

        return redirect()->route('admin.produtos.index')
            ->with('success', 'Produto cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produto $produto)
    {
        $produto->load('fornecedor', 'pedidoItens.pedido');

        return view('admin.produtos.show', compact('produto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produto $produto)
    {
        $fornecedores = Fornecedor::where('ativo', true)->orderBy('nome')->get();

        return view('admin.produtos.edit', compact('produto', 'fornecedores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produto $produto)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'codigo_sku' => 'required|string|max:255|unique:produtos,codigo_sku,'.$produto->id,
            'descricao' => 'nullable|string',
            'fornecedor_id' => 'nullable|exists:fornecedores,id',
            'preco_custo' => 'required|numeric|min:0',
            'preco_venda' => 'required|numeric|min:0',
            'estoque_minimo' => 'required|integer|min:0',
            'estoque_atual' => 'required|integer|min:0',
            'unidade_medida' => 'required|string|max:10',
            'categoria' => 'nullable|string|max:255',
            'imagem' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'ativo' => 'boolean',
        ]);

        // Upload da imagem
        if ($request->hasFile('imagem')) {
            // Deleta a imagem antiga
            if ($produto->imagem) {
                Storage::disk('public')->delete($produto->imagem);
            }
            $validated['imagem'] = $request->file('imagem')->store('produtos', 'public');
        }

        $produto->update($validated);

        return redirect()->route('admin.produtos.index')
            ->with('success', 'Produto atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {
        try {
            // Deleta a imagem
            if ($produto->imagem) {
                Storage::disk('public')->delete($produto->imagem);
            }

            $produto->delete();

            return redirect()->route('admin.produtos.index')
                ->with('success', 'Produto excluído com sucesso!');
        } catch (Exception $e) {
            return redirect()->route('admin.produtos.index')
                ->with('error', 'Erro ao excluir produto. Verifique se não há pedidos vinculados.');
        }
    }
}
