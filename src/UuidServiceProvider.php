<?php

declare(strict_types=1);

namespace Stryber\Uuid;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

final class UuidServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerClasses();
        $this->registerMiddlewares();
    }

    private function registerClasses(): void
    {
        $this->app->bind(UuidGenerator::class, PersistentUuidGenerator::class);
        $this->app->singleton(PersistentUuidGenerator::class, fn() => PersistentUuidGenerator::instance());
    }

    private function registerMiddlewares(): void
    {
        /** @var Router $router */
        $router = $this->app['router'];
        $router->aliasMiddleware('requestId', SetRequestId::class);
    }
}
