<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\Fornecedor;
use App\Models\Produto;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Criar usuário administrador
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@supergestao.com',
            'password' => Hash::make('senha123'),
            'role' => 'admin',
            'active' => true,
        ]);

        // Criar usuário gerente
        User::create([
            'name' => 'Gerente',
            'email' => 'gerente@supergestao.com',
            'password' => Hash::make('senha123'),
            'role' => 'manager',
            'active' => true,
        ]);

        // Criar usuário comum
        User::create([
            'name' => 'Usuário Teste',
            'email' => 'usuario@supergestao.com',
            'password' => Hash::make('senha123'),
            'role' => 'user',
            'active' => true,
        ]);

        // Criar clientes
        Cliente::create([
            'nome' => 'João Silva',
            'cpf_cnpj' => '123.456.789-00',
            'tipo' => 'fisica',
            'email' => 'joao@email.com',
            'telefone' => '(11) 98765-4321',
            'celular' => '(11) 91234-5678',
            'cep' => '01310-100',
            'endereco' => 'Av. Paulista',
            'numero' => '1000',
            'complemento' => 'Apto 101',
            'bairro' => 'Bela Vista',
            'cidade' => 'São Paulo',
            'estado' => 'SP',
            'ativo' => true,
        ]);

        Cliente::create([
            'nome' => 'Empresa XYZ Ltda',
            'cpf_cnpj' => '12.345.678/0001-90',
            'tipo' => 'juridica',
            'email' => 'contato@empresaxyz.com',
            'telefone' => '(11) 3000-0000',
            'cep' => '04543-907',
            'endereco' => 'Av. Brigadeiro Faria Lima',
            'numero' => '3000',
            'bairro' => 'Itaim Bibi',
            'cidade' => 'São Paulo',
            'estado' => 'SP',
            'ativo' => true,
        ]);

        // Criar fornecedores
        $fornecedor1 = Fornecedor::create([
            'nome' => 'Fornecedor ABC',
            'cnpj' => '11.222.333/0001-44',
            'razao_social' => 'ABC Comércio e Indústria Ltda',
            'email' => 'contato@fornecedorabc.com',
            'telefone' => '(11) 4000-0000',
            'cep' => '05508-900',
            'endereco' => 'Av. das Nações Unidas',
            'numero' => '12000',
            'bairro' => 'Brooklin',
            'cidade' => 'São Paulo',
            'estado' => 'SP',
            'contato_nome' => 'Carlos Souza',
            'ativo' => true,
        ]);

        // Criar produtos
        Produto::create([
            'nome' => 'Notebook Dell Inspiron 15',
            'codigo_sku' => 'NB-DELL-001',
            'descricao' => 'Notebook Dell Inspiron 15, Intel Core i5, 8GB RAM, 256GB SSD',
            'fornecedor_id' => $fornecedor1->id,
            'preco_custo' => 2500.00,
            'preco_venda' => 3500.00,
            'estoque_minimo' => 5,
            'estoque_atual' => 15,
            'unidade_medida' => 'UN',
            'categoria' => 'Informática',
            'ativo' => true,
        ]);

        Produto::create([
            'nome' => 'Mouse Logitech MX Master 3',
            'codigo_sku' => 'MS-LOG-001',
            'descricao' => 'Mouse sem fio Logitech MX Master 3, sensor de alta precisão',
            'fornecedor_id' => $fornecedor1->id,
            'preco_custo' => 350.00,
            'preco_venda' => 550.00,
            'estoque_minimo' => 10,
            'estoque_atual' => 25,
            'unidade_medida' => 'UN',
            'categoria' => 'Informática',
            'ativo' => true,
        ]);

        Produto::create([
            'nome' => 'Teclado Mecânico Keychron K2',
            'codigo_sku' => 'TC-KEY-001',
            'descricao' => 'Teclado mecânico sem fio Keychron K2, switches Blue',
            'fornecedor_id' => $fornecedor1->id,
            'preco_custo' => 450.00,
            'preco_venda' => 700.00,
            'estoque_minimo' => 8,
            'estoque_atual' => 3,
            'unidade_medida' => 'UN',
            'categoria' => 'Informática',
            'ativo' => true,
        ]);
    }
}
