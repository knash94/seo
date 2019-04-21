<?php

namespace Knash94\Seo\Tests\Unit;

use Knash94\Seo\Tests\Unit\Exception\Handler;

class TestCase extends \Orchestra\Testbench\BrowserKit\TestCase
{
    /**
     * Loads the migrations, factories and binds the ExceptionHandler for testing
     */
    protected function setUp()
    {
        parent::setUp();
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->loadFactories();
        $this->app->singleton(\Illuminate\Contracts\Debug\ExceptionHandler::class, Handler::class);
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

    /**
     * Loads the factories used during tests
     */
    protected function loadFactories()
    {
        $this->withFactories(__DIR__ . '/../factories');
    }
}