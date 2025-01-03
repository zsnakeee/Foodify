<?php

namespace Tests;

use Artisan;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    //    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        Artisan::call('db:seed');
    }
}
