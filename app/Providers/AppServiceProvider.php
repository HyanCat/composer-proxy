<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('App\Contracts\ComposerProxyContract', 'App\Services\ComposerProxy', true);
		$this->app->bind('App\Contracts\ComposerSyncContract', 'App\Services\ComposerSync', true);
	}
}
