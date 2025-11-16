<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\Produto;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProcessarPedidoAction
{
    /**
     * Processa um novo pedido.
     *
     * @throws Exception
     */
    public function execute(array $data): Pedido
    {
        DB::beginTransaction();

        try {
            // Calcula o valor total
            $valorTotal = 0;
            foreach ($data['produtos'] as $item) {
                $valorTotal += $item['quantidade'] * $item['preco_unitario'];
            }

            // Cria o pedido
            $pedido = Pedido::create([
                'numero_pedido' => Pedido::gerarNumeroPedido(),
                'cliente_id' => $data['cliente_id'],
                'user_id' => auth()->id(),
                'data_pedido' => $data['data_pedido'],
                'data_entrega_prevista' => $data['data_entrega_prevista'] ?? null,
                'status' => $data['status'],
                'valor_total' => $valorTotal,
                'desconto' => $data['desconto'] ?? 0,
                'valor_final' => $valorTotal - ($data['desconto'] ?? 0),
                'observacoes' => $data['observacoes'] ?? null,
            ]);

            // Cria os itens do pedido e atualiza estoque
            foreach ($data['produtos'] as $item) {
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

            Log::info('Pedido processado com sucesso', [
                'pedido_id' => $pedido->id,
                'numero_pedido' => $pedido->numero_pedido,
            ]);

            return $pedido;
        } catch (Exception $e) {
            DB::rollBack();

            Log::error('Erro ao processar pedido', [
                'error' => $e->getMessage(),
                'data' => $data,
            ]);

            throw $e;
        }
    }
}
