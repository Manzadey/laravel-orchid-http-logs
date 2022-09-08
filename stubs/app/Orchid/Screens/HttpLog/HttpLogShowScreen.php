<?php

declare(strict_types=1);

namespace App\Orchid\Screens\HttpLog;

use Manzadey\LaravelOrchidHelpers\Orchid\Helpers\Layouts\ModelLegendLayout;
use Manzadey\LaravelOrchidHelpers\Orchid\Helpers\Layouts\ModelTimestampsLayout;
use Manzadey\LaravelOrchidHelpers\Orchid\Helpers\Screens\ModelScreen;
use Manzadey\LaravelOrchidHelpers\Orchid\Helpers\Sights\EntitySight;
use Manzadey\LaravelOrchidHelpers\Orchid\Helpers\Sights\IdSight;
use Manzadey\LaravelOrchidHelpers\Orchid\Helpers\Sights\PrintSight;
use Manzadey\LaravelOrchidHelpers\Orchid\Helpers\Sights\Sight;
use Manzadey\OrchidHttpLog\Models\HttpLog;

class HttpLogShowScreen extends ModelScreen
{
    /**
     * Query data.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return array
     */
    public function query(HttpLog $httpLog): iterable
    {
        $this->authorizeShow($httpLog);

        return $this->model($httpLog);
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            ModelLegendLayout::make([
                IdSight::make(),
                EntitySight::make('user', __('Пользователь')),
                Sight::make('ip', __('IP')),
                Sight::make('name', __('Маршрут')),
                Sight::make('method', __('Метод')),
                Sight::make('scheme', __('Схема')),
                Sight::make('host', __('Хост')),
                Sight::make('port', __('Порт')),
                Sight::make('path'),
                PrintSight::make('query'),
                PrintSight::make('payload'),
                PrintSight::make('headers'),
            ]),

            ModelTimestampsLayout::make(),
        ];
    }
}
