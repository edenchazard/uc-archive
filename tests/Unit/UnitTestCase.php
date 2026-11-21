<?php

namespace Tests\Unit;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\TestCase;
use RuntimeException;

abstract class UnitTestCase extends TestCase
{
    public function createApplication(): Application
    {
        $app = require __DIR__.'/../../bootstrap/app.php';

        if (! $app instanceof Application) {
            throw new RuntimeException('The application bootstrap did not return an Application instance.');
        }

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }
}
