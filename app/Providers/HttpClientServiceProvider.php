<?php

namespace App\Providers;

use Buzz\Browser;
use Buzz\Client\Curl;
use Illuminate\Support\ServiceProvider;

class HttpClientServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('http.client', function ($app) {
			$client = new Curl();
			$client->setTimeout(30);

			return new Browser($client);
		});
	}

	public function provides()
	{
		return ['http.client'];
	}
}
