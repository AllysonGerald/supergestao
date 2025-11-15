<?php

namespace App\Actions;

use App\Models\Pedido;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CancelarPedidoAction
{
    /**
     * Cancela um pedido e retorna os produtos ao estoque
     *
     * @param Pedido $pedido
     * @return bool
     * @throws \Exception
     */
    public function execute(Pedido $pedido): bool
    {
        DB::beginTransaction();

        try {
            // Retorna os produtos ao estoque
            foreach ($pedido->itens as $item) {
                $produto = $item->produto;
                $produto->estoque_atual += $item->quantidade;
                $produto->save();
            }

            // Atualiza o status do pedido
            $pedido->status = 'cancelado';
            $pedido->save();

            DB::commit();

            Log::info('Pedido cancelado com sucesso', [
                'pedido_id' => $pedido->id,
                'numero_pedido' => $pedido->numero_pedido,
            ]);

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('Erro ao cancelar pedido', [
                'pedido_id' => $pedido->id,
                'error' => $e->getMessage(),
            ]);

            throw $e;
        }
    }
}

