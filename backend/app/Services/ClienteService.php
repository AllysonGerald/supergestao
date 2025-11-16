<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Cliente;
use App\Repositories\Contracts\ClienteRepositoryInterface;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ClienteService
{
    public function __construct(
        protected ClienteRepositoryInterface $clienteRepository
    ) {
    }

    /**
     * Lista clientes com paginação e filtros.
     */
    public function listarClientes(int $perPage = 10, array $filters = []): LengthAwarePaginator
    {
        return $this->clienteRepository->paginate($perPage, $filters);
    }

    /**
     * Busca cliente por ID.
     */
    public function buscarCliente(int $id): ?Cliente
    {
        return $this->clienteRepository->find($id);
    }

    /**
     * Cria um novo cliente.
     */
    public function criarCliente(array $data): Cliente
    {
        DB::beginTransaction();

        try {
            // Formata CPF/CNPJ removendo caracteres especiais
            if (isset($data['cpf_cnpj'])) {
                $data['cpf_cnpj'] = preg_replace('/\D/', '', $data['cpf_cnpj']);
            }

            // Formata CEP
            if (isset($data['cep'])) {
                $data['cep'] = preg_replace('/\D/', '', $data['cep']);
            }

            $cliente = $this->clienteRepository->create($data);

            DB::commit();

            Log::info('Cliente criado', ['cliente_id' => $cliente->id]);

            return $cliente;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Erro ao criar cliente', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * Atualiza cliente existente.
     */
    public function atualizarCliente(int $id, array $data): bool
    {
        DB::beginTransaction();

        try {
            // Formata CPF/CNPJ removendo caracteres especiais
            if (isset($data['cpf_cnpj'])) {
                $data['cpf_cnpj'] = preg_replace('/\D/', '', $data['cpf_cnpj']);
            }

            // Formata CEP
            if (isset($data['cep'])) {
                $data['cep'] = preg_replace('/\D/', '', $data['cep']);
            }

            $updated = $this->clienteRepository->update($id, $data);

            DB::commit();

            Log::info('Cliente atualizado', ['cliente_id' => $id]);

            return $updated;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Erro ao atualizar cliente', ['cliente_id' => $id, 'error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * Deleta um cliente.
     */
    public function deletarCliente(int $id): bool
    {
        DB::beginTransaction();

        try {
            $deleted = $this->clienteRepository->delete($id);

            DB::commit();

            Log::info('Cliente deletado', ['cliente_id' => $id]);

            return $deleted;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Erro ao deletar cliente', ['cliente_id' => $id, 'error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * Busca clientes ativos.
     */
    public function buscarClientesAtivos(): Collection
    {
        return $this->clienteRepository->getAtivos();
    }

    /**
     * Verifica se email já existe.
     */
    public function emailExiste(string $email, ?int $ignorarId = null): bool
    {
        $cliente = $this->clienteRepository->findByEmail($email);

        if (!$cliente) {
            return false;
        }

        if ($ignorarId && $cliente->id === $ignorarId) {
            return false;
        }

        return true;
    }

    /**
     * Verifica se CPF/CNPJ já existe.
     */
    public function cpfCnpjExiste(string $cpfCnpj, ?int $ignorarId = null): bool
    {
        $cliente = $this->clienteRepository->findByCpfCnpj($cpfCnpj);

        if (!$cliente) {
            return false;
        }

        if ($ignorarId && $cliente->id === $ignorarId) {
            return false;
        }

        return true;
    }
}
