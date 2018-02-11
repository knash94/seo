<?php namespace Knash94\Seo;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Knash94\Seo\Contracts\HttpErrorsContract;
use Knash94\Seo\Contracts\HttpRedirectsContract;
use Knash94\Seo\Contracts\PageNotFoundHandlerContract;
use Knash94\Seo\Services\Pagination;
use Knash94\Seo\Store\Eloquent\Repositories\HttpErrors;
use Knash94\Seo\Store\Eloquent\Repositories\HttpRedirects;

class SeoServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->registerRoutes();

        $this->loadViewsFrom(__DIR__.'\..\views', 'seo-tools');

        $this->publishes([
            __DIR__.'/../config/seo-tools.php' => config_path('seo-tools.php')
        ], 'config');
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
	    $this->app->bind(HttpErrorsContract::class, HttpErrors::class);
	    $this->app->bind(PageNotFoundHandlerContract::class, PageNotFoundHandler::class);
        $this->app->bind(HttpRedirectsContract::class, HttpRedirects::class);
    }

    protected function registerRoutes()
    {
        include __DIR__.'/routes.php';
    }

}
