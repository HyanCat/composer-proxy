<?php
/**
 * ComposerProxyServiceProvider.php
 * composer-proxy
 *
 * Created by HyanCat on 15/9/7.
 * Copyright (C) 2015 HyanCat. All rights reserved.
 */


namespace App\Providers;


use App\Services\ComposerProxy;
use Illuminate\Support\ServiceProvider;

class ComposerProxyServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->app->bind('App\Contracts\ComposerProxyContract', 'App\Services\ComposerProxy', true);
	}

}