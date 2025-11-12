<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_pedido',
        'cliente_id',
        'user_id',
        'data_pedido',
        'data_entrega_prevista',
        'status',
        'valor_total',
        'desconto',
        'valor_final',
        'observacoes',
    ];

    protected $casts = [
        'data_pedido' => 'date',
        'data_entrega_prevista' => 'date',
        'valor_total' => 'decimal:2',
        'desconto' => 'decimal:2',
        'valor_final' => 'decimal:2',
    ];

    /**
     * Relacionamento com cliente
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    /**
     * Relacionamento com usuário
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relacionamento com itens do pedido
     */
    public function itens()
    {
        return $this->hasMany(PedidoItem::class);
    }

    /**
     * Gera o número do pedido automaticamente
     */
    public static function gerarNumeroPedido(): string
    {
        $ultimoPedido = self::orderBy('id', 'desc')->first();
        $numero = $ultimoPedido ? $ultimoPedido->id + 1 : 1;
        
        return 'PED' . date('Y') . str_pad($numero, 6, '0', STR_PAD_LEFT);
    }

    /**
     * Calcula o valor final do pedido
     */
    public function calcularValorFinal(): void
    {
        $this->valor_final = $this->valor_total - $this->desconto;
        $this->save();
    }
}

