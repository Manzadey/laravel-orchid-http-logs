<?php

declare(strict_types=1);

namespace Manzadey\OrchidHttpLog\Models;

use App\Models\User;
use DragonCode\LaravelHttpLogger\Models\HttpLog as BaseHttpLog;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class HttpLog extends BaseHttpLog
{
    use AsSource;
    use Filterable;

    protected array $allowedFilters = [
        'id',
        'user_id',
        'path',
        'ip',
        'method',
    ];

    protected array $allowedSorts = [
        'id',
        'created_at',
        'user_id',
        'method',
    ];

    protected $fillable = [
        'name',
        'method',
        'scheme',
        'host',
        'port',
        'path',
        'query',
        'payload',
        'headers',
        'ip',
        'user_id',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
