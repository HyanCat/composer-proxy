<?php

require_once __DIR__ . '/../vendor/autoload.php';

Dotenv::load(__DIR__ . '/../');

$app = new Laravel\Lumen\Application(realpath(__DIR__ . '/../'));

$app->withFacades();

$app->singleton(Illuminate\Contracts\Console\Kernel::class, App\Console\Kernel::class);

$app->register(App\Providers\AppServiceProvider::class);
$app->register(App\Providers\EventServiceProvider::class);
$app->register(App\Providers\HttpClientServiceProvider::class);

$app->configure('app');
$app->configure('composer');

$app->group(['namespace' => 'App\Http\Controllers'], function ($app) {
	require __DIR__ . '/../app/Http/routes.php';
});

return $app;
