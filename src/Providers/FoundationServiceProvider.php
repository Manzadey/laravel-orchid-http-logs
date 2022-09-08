<?php

declare(strict_types=1);

namespace Manzadey\OrchidHttpLog\Providers;

use Illuminate\Support\ServiceProvider;
use Manzadey\OrchidHttpLog\Console\Commands\InstallCommand;

class FoundationServiceProvider extends ServiceProvider
{
    public function register() : void
    {
        $this->commands(InstallCommand::class);

        $this->mergeConfigFrom(__DIR__ . '/../../config/http-logger.php', 'http-logger');
    }

    public function boot() : void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        $this->publishes([
            __DIR__ . '/../../stubs/app'    => app_path(),
            __DIR__ . '/../../stubs/routes' => base_path('routes/platform'),
        ], 'orchid-http-log-stubs');

        $this->publishes([
            __DIR__ . '/../../config' => config_path(),
        ], 'orchid-http-log-config');
    }
}
