<?php

namespace App\Repositories;

use App\Models\Cliente;
use App\Repositories\Contracts\ClienteRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ClienteRepository implements ClienteRepositoryInterface
{
    public function __construct(
        protected Cliente $model
    ) {}

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function paginate(int $perPage = 10, array $filters = []): LengthAwarePaginator
    {
        $query = $this->model->query();

        if (isset($filters['busca'])) {
            $busca = $filters['busca'];
            $query->where(function($q) use ($busca) {
                $q->where('nome', 'like', "%{$busca}%")
                  ->orWhere('email', 'like', "%{$busca}%")
                  ->orWhere('cpf_cnpj', 'like', "%{$busca}%");
            });
        }

        if (isset($filters['tipo'])) {
            $query->where('tipo', $filters['tipo']);
        }

        if (isset($filters['ativo'])) {
            $query->where('ativo', $filters['ativo']);
        }

        return $query->orderBy('nome')->paginate($perPage);
    }

    public function find(int $id): ?Cliente
    {
        return $this->model->find($id);
    }

    public function create(array $data): Cliente
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): bool
    {
        $cliente = $this->find($id);
        
        if (!$cliente) {
            return false;
        }

        return $cliente->update($data);
    }

    public function delete(int $id): bool
    {
        $cliente = $this->find($id);
        
        if (!$cliente) {
            return false;
        }

        return $cliente->delete();
    }

    public function findByEmail(string $email): ?Cliente
    {
        return $this->model->where('email', $email)->first();
    }

    public function findByCpfCnpj(string $cpfCnpj): ?Cliente
    {
        return $this->model->where('cpf_cnpj', $cpfCnpj)->first();
    }

    public function getAtivos(): Collection
    {
        return $this->model->where('ativo', true)->get();
    }

    public function search(string $term): Collection
    {
        return $this->model->where('nome', 'like', "%{$term}%")
            ->orWhere('email', 'like', "%{$term}%")
            ->orWhere('cpf_cnpj', 'like', "%{$term}%")
            ->get();
    }
}

