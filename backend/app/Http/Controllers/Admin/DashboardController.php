<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Fornecedor;
use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Exibe o dashboard administrativo.
     */
    public function index()
    {
        // Estatísticas gerais
        $totalClientes = Cliente::where('ativo', true)->count();
        $totalFornecedores = Fornecedor::where('ativo', true)->count();
        $totalProdutos = Produto::where('ativo', true)->count();
        $totalPedidos = Pedido::count();

        // Pedidos por status
        $pedidosPorStatus = Pedido::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        // Produtos com estoque baixo
        $produtosEstoqueBaixo = Produto::whereColumn('estoque_atual', '<=', 'estoque_minimo')
            ->where('ativo', true)
            ->count();

        // Valor total dos pedidos do mês
        $valorPedidosMes = Pedido::whereMonth('data_pedido', date('m'))
            ->whereYear('data_pedido', date('Y'))
            ->sum('valor_final');

        // Últimos pedidos
        $ultimosPedidos = Pedido::with(['cliente', 'user'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Produtos mais vendidos
        $produtosMaisVendidos = Produto::withCount(['pedidoItens as total_vendido' => function ($query): void {
            $query->select(DB::raw('sum(quantidade)'));
        }])
            ->orderBy('total_vendido', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalClientes',
            'totalFornecedores',
            'totalProdutos',
            'totalPedidos',
            'pedidosPorStatus',
            'produtosEstoqueBaixo',
            'valorPedidosMes',
            'ultimosPedidos',
            'produtosMaisVendidos'
        ));
    }
}
