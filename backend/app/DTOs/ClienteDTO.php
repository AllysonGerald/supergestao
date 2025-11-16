<?php

declare(strict_types=1);

namespace App\DTOs;

class ClienteDTO
{
    public function __construct(
        public readonly string $nome,
        public readonly string $cpfCnpj,
        public readonly string $tipo,
        public readonly string $email,
        public readonly string $telefone,
        public readonly ?string $celular,
        public readonly string $cep,
        public readonly string $endereco,
        public readonly string $numero,
        public readonly ?string $complemento,
        public readonly string $bairro,
        public readonly string $cidade,
        public readonly string $estado,
        public readonly ?string $observacoes,
        public readonly bool $ativo = true,
    ) {
    }

    /**
     * Cria DTO a partir de array.
     */
    public static function fromArray(array $data): self
    {
        return new self(
            nome: $data['nome'],
            cpfCnpj: $data['cpf_cnpj'],
            tipo: $data['tipo'],
            email: $data['email'],
            telefone: $data['telefone'],
            celular: $data['celular'] ?? null,
            cep: $data['cep'],
            endereco: $data['endereco'],
            numero: $data['numero'],
            complemento: $data['complemento'] ?? null,
            bairro: $data['bairro'],
            cidade: $data['cidade'],
            estado: $data['estado'],
            observacoes: $data['observacoes'] ?? null,
            ativo: $data['ativo'] ?? true,
        );
    }

    /**
     * Converte DTO para array.
     */
    public function toArray(): array
    {
        return [
            'nome' => $this->nome,
            'cpf_cnpj' => $this->cpfCnpj,
            'tipo' => $this->tipo,
            'email' => $this->email,
            'telefone' => $this->telefone,
            'celular' => $this->celular,
            'cep' => $this->cep,
            'endereco' => $this->endereco,
            'numero' => $this->numero,
            'complemento' => $this->complemento,
            'bairro' => $this->bairro,
            'cidade' => $this->cidade,
            'estado' => $this->estado,
            'observacoes' => $this->observacoes,
            'ativo' => $this->ativo,
        ];
    }
}
