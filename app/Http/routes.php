<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
 */

$app->get('/', 'Controller@index');

$app->get('{repo}/packages.json', 'Controller@packages');

$app->get('{repo}/p/{provider}${hash}.json', 'Controller@provider');
$app->get('{repo}/p/{namespace}/{package}${hash}.json', 'Controller@packageHashed');

$app->get('{repo}/p/{namespace}/{package}.json', 'Controller@package');