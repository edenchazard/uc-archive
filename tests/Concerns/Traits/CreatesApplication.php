<?php

namespace Tests\Concerns\Traits;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;
use RuntimeException;

trait CreatesApplication
{
    public function createApplication(): Application
    {
        $app = require __DIR__.'/../../../bootstrap/app.php';

        if (! $app instanceof Application) {
            throw new RuntimeException('The application bootstrap did not return an Application instance.');
        }

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }
}
