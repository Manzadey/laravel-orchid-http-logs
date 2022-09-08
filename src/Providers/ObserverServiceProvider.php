<?php

declare(strict_types=1);

namespace Manzadey\OrchidHttpLog\Providers;

use DragonCode\LaravelHttpLogger\Models\HttpLog;
use Illuminate\Support\ServiceProvider;
use Manzadey\OrchidHttpLog\Observers\HttpLogObserver;

class ObserverServiceProvider extends ServiceProvider
{
    public function boot() : void
    {
        HttpLog::observe(HttpLogObserver::class);
    }
}
