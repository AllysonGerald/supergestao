<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'codigo_sku',
        'descricao',
        'fornecedor_id',
        'preco_custo',
        'preco_venda',
        'estoque_minimo',
        'estoque_atual',
        'unidade_medida',
        'categoria',
        'imagem',
        'ativo',
    ];

    protected $casts = [
        'preco_custo' => 'decimal:2',
        'preco_venda' => 'decimal:2',
        'estoque_minimo' => 'integer',
        'estoque_atual' => 'integer',
        'ativo' => 'boolean',
    ];

    /**
     * Relacionamento com fornecedor.
     */
    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
    }

    /**
     * Relacionamento com itens de pedido.
     */
    public function pedidoItens()
    {
        return $this->hasMany(PedidoItem::class);
    }

    /**
     * Verifica se o estoque está baixo.
     */
    public function isEstoqueBaixo(): bool
    {
        return $this->estoque_atual <= $this->estoque_minimo;
    }

    /**
     * Calcula a margem de lucro.
     */
    public function getMargemLucroAttribute(): float
    {
        if (0 == $this->preco_custo) {
            return 0;
        }

        return (($this->preco_venda - $this->preco_custo) / $this->preco_custo) * 100;
    }
}
