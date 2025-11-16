<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Models\Produto;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface ProdutoRepositoryInterface
{
    public function paginate(int $perPage = 10, array $filters = []): LengthAwarePaginator;

    public function find(int $id): ?Produto;

    public function create(array $data): Produto;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;

    public function getEstoqueBaixo(): Collection;

    public function atualizarEstoque(int $id, int $quantidade): bool;
}
