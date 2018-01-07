<?php

namespace Tests;


use Easteregg\Comment\CommentEventProvider;
use Easteregg\Comment\CommentServiceProvider;
use Easteregg\Setting\SettingServiceProvider;
use Orchestra\Testbench\TestCase as TestBenchCase;

abstract class TestCase extends TestBenchCase
{

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        //$this->withFactories(__DIR__ . '/factories');

        $this->migrateTables();
    }


    private function migrateTables()
    {
        $this->artisan('migrate', [
            '--database' => 'testing',
        ]);

    }


    protected function getPackageProviders($app)
    {
        return [
            CommentServiceProvider::class,
            CommentEventProvider::class,
            SettingServiceProvider::class,
            TestingServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetup($app)
    {
        $app['config']->set('translatable.locales', ['en']);
        $app['config']->set('app.locale', 'en');
        $app['config']->set('comment.dashboardLayout','comment::master');
    }
}
