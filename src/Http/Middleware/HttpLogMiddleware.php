<?php

declare(strict_types=1);

namespace Manzadey\OrchidHttpLog\Http\Middleware;

use Closure;
use DragonCode\LaravelHttpLogger\Services\Logger;
use Illuminate\Http\Request;

class HttpLogMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($this->enabled() && $this->allowedMethod($request->method()) && $this->hasIgnoreRoute($request->route()?->getName())) {
            Logger::save($request);
        }

        return $next($request);
    }

    protected function enabled(): bool
    {
        return config('http-logger.enabled', true);
    }

    protected function hasIgnoreRoute(?string $route) : bool
    {
        if($route === null) {
            return true;
        }

        return !in_array($route, config('http-logger.ignore_routes', []), true);
    }

    private function allowedMethod(string $method) : bool
    {
        $methods = config('http-logger.allowed_methods');

        if(empty($methods)) {
            return true;
        }

        return in_array($method, config('http-logger.allowed_methods'), false);
    }
}
