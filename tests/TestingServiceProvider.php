<?php

namespace Tests;

use Illuminate\Support\ServiceProvider;

class TestingServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/migrations');
    }
}
