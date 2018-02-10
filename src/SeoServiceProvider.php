<?php namespace Knash94\Seo;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Knash94\Seo\Contracts\NotFoundContract;
use Knash94\Seo\Store\Eloquent\Repositories\NotFound;

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
	    app()->bind(NotFoundContract::class, NotFound::class);
	}

}
