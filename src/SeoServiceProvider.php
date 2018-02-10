<?php namespace Knash94\Seo;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Knash94\Seo\Contracts\HttpErrorsContract;
use Knash94\Seo\Contracts\PageNotFoundHandlerContract;
use Knash94\Seo\Store\Eloquent\Repositories\HttpErrors;

class SeoServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
	    app()->bind(HttpErrorsContract::class, HttpErrors::class);
	    app()->bind(PageNotFoundHandlerContract::class, PageNotFoundHandler::class);
	}

}
