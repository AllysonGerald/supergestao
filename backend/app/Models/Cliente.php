<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'cpf_cnpj',
        'tipo',
        'email',
        'telefone',
        'celular',
        'cep',
        'endereco',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',
        'observacoes',
        'ativo',
    ];

    protected $casts = [
        'ativo' => 'boolean',
    ];

    /**
     * Relacionamento com pedidos
     */
    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

    /**
     * Formata o CPF/CNPJ
     */
    public function getCpfCnpjFormatadoAttribute(): string
    {
        $documento = preg_replace('/\D/', '', $this->cpf_cnpj);
        
        if (strlen($documento) === 11) {
            return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $documento);
        } elseif (strlen($documento) === 14) {
            return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $documento);
        }
        
        return $this->cpf_cnpj;
    }
}

