<?php

declare(strict_types=1);

namespace App\Orchid\Screens\HttpLog;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;
use Manzadey\LaravelOrchidHelpers\Orchid\Filters\CreatedTimestampFilter;
use Manzadey\LaravelOrchidHelpers\Orchid\Filters\UserFilter;
use Manzadey\LaravelOrchidHelpers\Orchid\Helpers\Layouts\ModelsTableLayout;
use Manzadey\LaravelOrchidHelpers\Orchid\Helpers\Links\DropdownOptions;
use Manzadey\LaravelOrchidHelpers\Orchid\Helpers\Links\ShowLink;
use Manzadey\LaravelOrchidHelpers\Orchid\Helpers\Screens\AbstractScreen;
use Manzadey\LaravelOrchidHelpers\Orchid\Helpers\TD\ActionsTD;
use Manzadey\LaravelOrchidHelpers\Orchid\Helpers\TD\CreatedAtTD;
use Manzadey\LaravelOrchidHelpers\Orchid\Helpers\TD\EntityRelationTD;
use Manzadey\LaravelOrchidHelpers\Orchid\Helpers\TD\IdTD;
use Manzadey\OrchidHttpLog\Models\HttpLog;
use Manzadey\OrchidHttpLog\Orchid\Layouts\HttpLogChart;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Layouts\Selection;
use Orchid\Screen\TD;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use stdClass;

class HttpLogListScreen extends AbstractScreen
{
    /**
     * Query data.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return array
     */
    public function query() : iterable
    {
        $this->authorizeList(HttpLog::class);

        return [
            'models' => HttpLog::filters()
                ->filtersApplySelection($this->selection())
                ->latest('id')
                ->with('user')
                ->paginate(),

            'charts' => [
                $this->generateChartData(),
            ],
        ];
    }

    public function commandBar() : iterable
    {
        return [
            Button::make(__('Удалить все'))
                ->icon('trash')
                ->type(Color::DANGER())
                ->method('deleteAll')
                ->confirm(__('Вы действительно хотите удалить все записи?')),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout() : iterable
    {
        return [
            $this->selection(),

            HttpLogChart::class,

            ModelsTableLayout::make([
                IdTD::make(),
                EntityRelationTD::make('user', __('Пользователь')),
                TD::make('method', __('Метод'))
                    ->filter(TD::FILTER_SELECT)
                    ->filterOptions([
                        'GET'  => 'GET',
                        'POST' => 'POST',
                    ]),
                TD::make('path', __('Путь')),
                TD::make('ip'),
                CreatedAtTD::make(),
                ActionsTD::make(static fn(HttpLog $httpLog) : DropDown => DropdownOptions::make()
                    ->list([
                        ShowLink::route('platform.http-logs.show', $httpLog),
                    ])),
            ]),
        ];
    }

    private function selection() : Selection
    {
        return Layout::selection([
            UserFilter::class,
            CreatedTimestampFilter::class,
        ]);
    }

    /**
     * @return array[]
     */
    public function generateChartData() : array
    {
        $results = DB::table('http_logs')
            ->selectRaw('COUNT(*) as count, DATE_FORMAT(created_at, "%d.%m.%Y") as date')
            ->groupBy('date')
            ->get();

        $values = $labels = [];
        array_map(static function(Carbon $carbon) use ($results, &$labels, &$values) : void {
            $date  = $carbon->format('d.m.Y');
            $value = 0;

            $labels[] = $date;
            $key      = $results->search(static fn(stdClass $value) => $value->date === $date);

            if($key !== false) {
                $value = $results->get($key)->count;
            }

            $values[] = $value;
        }, CarbonPeriod::create(now()->subDays(14), now())->toArray());

        return compact('labels', 'values');
    }
}
