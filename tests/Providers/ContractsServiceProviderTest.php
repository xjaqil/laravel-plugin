<?php

namespace Aqil\LaravelPlugin\Tests\Providers;

use Aqil\LaravelPlugin\Contracts\RepositoryInterface;
use Aqil\LaravelPlugin\Support\Repositories\FileRepository;
use Aqil\LaravelPlugin\Tests\TestCase;

class ContractsServiceProviderTest extends TestCase
{
    public function test_it_binds_repository_interface_with_implementation()
    {
        $this->assertInstanceOf(FileRepository::class, app(RepositoryInterface::class));
    }
}
