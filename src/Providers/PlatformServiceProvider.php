<?php

declare(strict_types=1);

namespace Manzadey\OrchidHttpLog\Providers;

use Manzadey\LaravelOrchidHelpers\Services\PlatformPermissionService;
use Manzadey\OrchidHttpLog\Models\HttpLog;
use Orchid\Platform\OrchidServiceProvider;

class PlatformServiceProvider extends OrchidServiceProvider
{
    public function registerPermissions() : array
    {
        $permissionService = PlatformPermissionService::make();

        return collect([HttpLog::class])
            ->map(static fn(string $model) => $permissionService->getPlatformProviderPermissions($model))
            ->toArray();
    }
}
