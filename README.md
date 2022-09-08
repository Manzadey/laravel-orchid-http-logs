# Laravel Orchid Activity Log

Laravel Orchid Activity Log wrapper.

## Packages

* [Laravel Http Logger by Dragon Code](https://github.com/TheDragonCode/laravel-http-logger)

## Installing

```shell
$ composer require manzadey/laravel-orchid-http-logs
```

## Usage

Install package:
```shell
$ php artisan orchid-http-log:install
```

Run migrate:
```shell
$ php artisan migrate
```

Add middleware `\Manzadey\OrchidHttpLog\Http\Middleware\HttpLogMiddleware::class` for routes.

## License

MIT
