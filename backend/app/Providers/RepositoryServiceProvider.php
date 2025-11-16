<?php

declare(strict_types=1);

namespace App\Providers;

use App\Repositories\ClienteRepository;
use App\Repositories\Contracts\ClienteRepositoryInterface;
use App\Repositories\Contracts\ProdutoRepositoryInterface;
use App\Repositories\ProdutoRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Bind Repository Interfaces to Implementations
        $this->app->bind(ClienteRepositoryInterface::class, ClienteRepository::class);
        $this->app->bind(ProdutoRepositoryInterface::class, ProdutoRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
    }
}
