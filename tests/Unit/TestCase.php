<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\Concerns\Traits\CreatesApplication;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
}
