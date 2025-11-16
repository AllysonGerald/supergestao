<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Produto;
use App\Repositories\Contracts\ProdutoRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ProdutoRepository implements ProdutoRepositoryInterface
{
    public function __construct(protected Produto $model)
    {
    }

    public function paginate(int $perPage = 10, array $filters = []): LengthAwarePaginator
    {
        $query = $this->model->with('fornecedor');

        if (isset($filters['busca'])) {
            $busca = $filters['busca'];
            $query->where(function ($q) use ($busca): void {
                $q->where('nome', 'like', "%{$busca}%")
                  ->orWhere('codigo_sku', 'like', "%{$busca}%")
                  ->orWhere('categoria', 'like', "%{$busca}%");
            });
        }

        if (isset($filters['categoria'])) {
            $query->where('categoria', $filters['categoria']);
        }

        if (isset($filters['ativo'])) {
            $query->where('ativo', $filters['ativo']);
        }

        if (isset($filters['estoque_baixo']) && '1' == $filters['estoque_baixo']) {
            $query->whereColumn('estoque_atual', '<=', 'estoque_minimo');
        }

        return $query->orderBy('nome')->paginate($perPage);
    }

    public function find(int $id): ?Produto
    {
        return $this->model->with('fornecedor')->find($id);
    }

    public function create(array $data): Produto
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->model->findOrFail($id)->update($data);
    }

    public function delete(int $id): bool
    {
        return $this->model->findOrFail($id)->delete();
    }

    public function getEstoqueBaixo(): Collection
    {
        return $this->model->whereColumn('estoque_atual', '<=', 'estoque_minimo')
            ->where('ativo', true)
            ->get();
    }

    public function atualizarEstoque(int $id, int $quantidade): bool
    {
        $produto = $this->find($id);

        if (!$produto) {
            return false;
        }

        $produto->estoque_atual += $quantidade;

        return $produto->save();
    }
}
