<?php

declare(strict_types=1);

use App\Orchid\Screens\HttpLog\HttpLogListScreen;
use App\Orchid\Screens\HttpLog\HttpLogShowScreen;
use Illuminate\Support\Facades\Route;
use Manzadey\OrchidHttpLog\Models\HttpLog;
use Manzadey\OrchidHttpLog\Services\HttpLogService;
use Tabuna\Breadcrumbs\Trail;

Route::prefix('http-logs')
    ->name('http-logs.')
    ->group(static function() {
        Route::screen('', HttpLogListScreen::class)
            ->name('list')
            ->breadcrumbs(static fn(Trail $trail) : Trail => $trail
                ->parent('platform.index')
                ->push(HttpLogService::NAME, route(HttpLogService::ROUTE_LIST))
            );

        Route::screen('{httpLog}', HttpLogShowScreen::class)
            ->name('show')
            ->breadcrumbs(static fn(Trail $trail, HttpLog $httpLog) : Trail => $trail
                ->parent(HttpLogService::ROUTE_LIST)
                ->push($httpLog->getAttribute('path'), route(HttpLogService::ROUTE_SHOW, $httpLog))
            );
    });
