<?php

declare(strict_types=1);

namespace Manzadey\OrchidHttpLog\Services;

class HttpLogService
{
    public const TITLE      = 'HTTP логи';

    public const PLURAL     = 'http-logs';

    public const ROUTE      = 'platform.' . self::PLURAL . '.';

    public const ROUTE_LIST = self::ROUTE . 'list';

    public const ROUTE_SHOW = self::ROUTE . 'show';

    public const ICON       = 'task';
}
