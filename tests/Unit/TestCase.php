<?php

namespace Knash94\Seo\Tests\Unit;


class TestCase extends \Orchestra\Testbench\TestCase
{
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
}