<?php

namespace Aqil\LaravelPlugin\Providers;

use Carbon\Laravel\ServiceProvider;
use Aqil\LaravelPlugin\Contracts\RepositoryInterface;
use Aqil\LaravelPlugin\Support\Repositories\FileRepository;

class ContractsServiceProvider extends ServiceProvider
{
    /**
     * Register some binding.
     */
    public function register()
    {
        $this->app->bind(RepositoryInterface::class, FileRepository::class);
    }
}
