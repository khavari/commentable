<?php

namespace Tests;


use Carbon\Carbon;
use Easteregg\Diagon\Helpers\Sluggify;
use Easteregg\Diagon\Product\Product;
use Faker\Factory;
use Orchestra\Testbench\TestCase as TestCommentCase;

abstract class TestCase extends TestCommentCase
{
    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->migrateTables();
    }



    private function migrateTables()
    {
        $this->artisan('migrate', [
            '--database' => 'testing',
            '--realpath' => realpath(__DIR__ . '/migrations'),
        ]);
    }





}
