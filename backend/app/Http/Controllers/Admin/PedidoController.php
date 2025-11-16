<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\Produto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pedido::with(['cliente', 'user']);

        // Busca
        if ($request->filled('busca')) {
            $busca = $request->busca;
            $query->where(function ($q) use ($busca): void {
                $q->where('numero_pedido', 'like', "%{$busca}%")
                  ->orWhereHas('cliente', function ($q) use ($busca): void {
                      $q->where('nome', 'like', "%{$busca}%");
                  });
            });
        }

        // Filtro por status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filtro por data
        if ($request->filled('data_inicio')) {
            $query->whereDate('data_pedido', '>=', $request->data_inicio);
        }
        if ($request->filled('data_fim')) {
            $query->whereDate('data_pedido', '<=', $request->data_fim);
        }

        $pedidos = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.pedidos.index', compact('pedidos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::where('ativo', true)->orderBy('nome')->get();
        $produtos = Produto::where('ativo', true)->orderBy('nome')->get();

        return view('admin.pedidos.create', compact('clientes', 'produtos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'data_pedido' => 'required|date',
            'data_entrega_prevista' => 'nullable|date',
            'status' => 'required|in:pendente,processando,enviado,entregue,cancelado',
            'desconto' => 'nullable|numeric|min:0',
            'observacoes' => 'nullable|string',
            'produtos' => 'required|array|min:1',
            'produtos.*.produto_id' => 'required|exists:produtos,id',
            'produtos.*.quantidade' => 'required|integer|min:1',
            'produtos.*.preco_unitario' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            // Calcula o valor total
            $valorTotal = 0;
            foreach ($validated['produtos'] as $item) {
                $valorTotal += $item['quantidade'] * $item['preco_unitario'];
            }

            // Cria o pedido
            $pedido = Pedido::create([
                'numero_pedido' => Pedido::gerarNumeroPedido(),
                'cliente_id' => $validated['cliente_id'],
                'user_id' => auth()->id(),
                'data_pedido' => $validated['data_pedido'],
                'data_entrega_prevista' => $validated['data_entrega_prevista'] ?? null,
                'status' => $validated['status'],
                'valor_total' => $valorTotal,
                'desconto' => $validated['desconto'] ?? 0,
                'valor_final' => $valorTotal - ($validated['desconto'] ?? 0),
                'observacoes' => $validated['observacoes'] ?? null,
            ]);

            // Cria os itens do pedido
            foreach ($validated['produtos'] as $item) {
                PedidoItem::create([
                    'pedido_id' => $pedido->id,
                    'produto_id' => $item['produto_id'],
                    'quantidade' => $item['quantidade'],
                    'preco_unitario' => $item['preco_unitario'],
                    'subtotal' => $item['quantidade'] * $item['preco_unitario'],
                ]);

                // Atualiza o estoque
                $produto = Produto::find($item['produto_id']);
                $produto->estoque_atual -= $item['quantidade'];
                $produto->save();
            }

            DB::commit();

            return redirect()->route('admin.pedidos.index')
                ->with('success', 'Pedido criado com sucesso!');
        } catch (Exception $e) {
            DB::rollBack();

            return back()->withInput()
                ->with('error', 'Erro ao criar pedido: '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        $pedido->load(['cliente', 'user', 'itens.produto']);

        return view('admin.pedidos.show', compact('pedido'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pedido $pedido)
    {
        $clientes = Cliente::where('ativo', true)->orderBy('nome')->get();
        $produtos = Produto::where('ativo', true)->orderBy('nome')->get();
        $pedido->load('itens.produto');

        return view('admin.pedidos.edit', compact('pedido', 'clientes', 'produtos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pedido $pedido)
    {
        $validated = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'data_pedido' => 'required|date',
            'data_entrega_prevista' => 'nullable|date',
            'status' => 'required|in:pendente,processando,enviado,entregue,cancelado',
            'desconto' => 'nullable|numeric|min:0',
            'observacoes' => 'nullable|string',
        ]);

        $pedido->update($validated);
        $pedido->calcularValorFinal();

        return redirect()->route('admin.pedidos.index')
            ->with('success', 'Pedido atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
        DB::beginTransaction();
        try {
            // Retorna os produtos ao estoque
            foreach ($pedido->itens as $item) {
                $produto = $item->produto;
                $produto->estoque_atual += $item->quantidade;
                $produto->save();
            }

            $pedido->delete();

            DB::commit();

            return redirect()->route('admin.pedidos.index')
                ->with('success', 'Pedido excluído com sucesso!');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->route('admin.pedidos.index')
                ->with('error', 'Erro ao excluir pedido.');
        }
    }

    /**
     * Busca produto por ID (AJAX).
     */
    public function buscarProduto($id)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return response()->json(['error' => 'Produto não encontrado'], 404);
        }

        return response()->json([
            'id' => $produto->id,
            'nome' => $produto->nome,
            'codigo_sku' => $produto->codigo_sku,
            'preco_venda' => $produto->preco_venda,
            'estoque_atual' => $produto->estoque_atual,
        ]);
    }
}
