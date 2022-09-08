<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use Manzadey\LaravelOrchidHelpers\Services\PlatformPermissionService;
use Manzadey\OrchidHttpLog\Models\HttpLog;

class HttpLogPolicy
{
    public function list(User $user) : bool
    {
        return $user->hasAccess(PlatformPermissionService::getPermission(HttpLog::class, 'list'));
    }

    public function show(User $user) : bool
    {
        return $user->hasAccess(PlatformPermissionService::getPermission(HttpLog::class, 'show'));
    }
}
