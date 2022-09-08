<?php

declare(strict_types=1);

namespace Manzadey\OrchidHttpLog\Orchid\Actions\Links;

use Manzadey\OrchidHttpLog\Models\HttpLog;
use Manzadey\OrchidHttpLog\Services\HttpLogService;
use Orchid\Screen\Actions\Link;

class HttpLogLink
{
    public static function make() : Link
    {
        return Link::make(HttpLogService::NAME)
            ->route(HttpLogService::ROUTE_LIST)
            ->icon(HttpLogService::ICON)
            ->can('list', HttpLog::class);
    }
}
