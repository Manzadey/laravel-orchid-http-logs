<?php

declare(strict_types=1);

namespace Manzadey\OrchidHttpLog\Console\Commands;

use Illuminate\Console\Command;
use Manzadey\OrchidHttpLog\Providers\FoundationServiceProvider;

class InstallCommand extends Command
{
    protected $signature = 'orchid-http-log:install';

    protected $description = 'Install Orchid Http Log';

    public function handle() : int
    {
        if($this->components->confirm('Install Http Log config?', true)) {
            $this->callHttpLogVendorPublish();
        }

        $this->callVendorPublish();

        $this->components->info('Package installed!');

        return 1;
    }

    private function callHttpLogVendorPublish() : void
    {
        $this->call('vendor:publish', [
            '--provider' => FoundationServiceProvider::class,
            '--tag'      => [
                'orchid-http-log-config',
            ],
        ]);
    }

    public function callVendorPublish() : void
    {
        $this->call('vendor:publish', [
            '--provider' => FoundationServiceProvider::class,
            '--tag'      => [
                'orchid-http-log-stubs',
            ],
        ]);
    }
}
