<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoItem extends Model
{
    use HasFactory;

    protected $table = 'pedido_itens';

    protected $fillable = [
        'pedido_id',
        'produto_id',
        'quantidade',
        'preco_unitario',
        'subtotal',
    ];

    protected $casts = [
        'quantidade' => 'integer',
        'preco_unitario' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    /**
     * Relacionamento com pedido
     */
    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    /**
     * Relacionamento com produto
     */
    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    /**
     * Calcula o subtotal do item
     */
    public function calcularSubtotal(): void
    {
        $this->subtotal = $this->quantidade * $this->preco_unitario;
        $this->save();
    }
}

