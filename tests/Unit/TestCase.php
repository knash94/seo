<?php

namespace Knash94\Seo\Tests\Unit;


class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function setUp()
    {
        parent::setUp();
        $this->loadMigrationsFrom(__DIR__ . '\..\..\database/migrations');
        $this->loadFactories();
    }
    /**
     * Loads the service provider
     *
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return ['Knash94\Seo\SeoServiceProvider'];
    }

    protected function loadFactories()
    {
        $this->withFactories(__DIR__ . '\..\factories');
    }
}