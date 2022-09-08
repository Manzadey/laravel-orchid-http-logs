<?php

declare(strict_types=1);

namespace Manzadey\OrchidHttpLog\Observers;

use DragonCode\LaravelHttpLogger\Models\HttpLog;

class HttpLogObserver
{
    public function saving(HttpLog $httpLog) : void
    {
        $httpLog->forceFill([
            'user_id' => auth()->id(),
        ]);
    }
}
