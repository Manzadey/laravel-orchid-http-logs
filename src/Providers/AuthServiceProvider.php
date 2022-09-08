<?php

declare(strict_types=1);

namespace Manzadey\OrchidHttpLog\Providers;

use App\Policies\HttpLogPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Manzadey\OrchidHttpLog\Models\HttpLog;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        HttpLog::class => HttpLogPolicy::class,
    ];

    public function boot() : void
    {
        $this->registerPolicies();
    }
}
