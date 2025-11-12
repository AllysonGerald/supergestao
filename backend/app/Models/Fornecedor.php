<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    use HasFactory;

    protected $table = 'fornecedores';

    protected $fillable = [
        'nome',
        'cnpj',
        'razao_social',
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
        'contato_nome',
        'observacoes',
        'ativo',
    ];

    protected $casts = [
        'ativo' => 'boolean',
    ];

    /**
     * Relacionamento com produtos
     */
    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }

    /**
     * Formata o CNPJ
     */
    public function getCnpjFormatadoAttribute(): string
    {
        $cnpj = preg_replace('/\D/', '', $this->cnpj);
        
        if (strlen($cnpj) === 14) {
            return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $cnpj);
        }
        
        return $this->cnpj;
    }
}

