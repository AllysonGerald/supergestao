<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Models\Cliente;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface ClienteRepositoryInterface
{
    public function all(): Collection;

    public function paginate(int $perPage = 10, array $filters = []): LengthAwarePaginator;

    public function find(int $id): ?Cliente;

    public function create(array $data): Cliente;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;

    public function findByEmail(string $email): ?Cliente;

    public function findByCpfCnpj(string $cpfCnpj): ?Cliente;

    public function getAtivos(): Collection;

    public function search(string $term): Collection;
}
