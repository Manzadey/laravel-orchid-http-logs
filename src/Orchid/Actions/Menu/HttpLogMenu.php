<?php

declare(strict_types=1);

namespace Manzadey\OrchidHttpLog\Orchid\Actions\Menu;

use Manzadey\OrchidHttpLog\Models\HttpLog;
use Manzadey\OrchidHttpLog\Services\HttpLogService;
use Orchid\Screen\Actions\Menu;

class HttpLogMenu
{
    public static function make() : Menu
    {
        return Menu::make(HttpLogService::NAME)
            ->route(HttpLogService::ROUTE_LIST)
            ->icon(HttpLogService::ICON)
            ->can('list', HttpLog::class);
    }
}
