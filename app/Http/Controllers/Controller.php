<?php

namespace App\Http\Controllers;

use App\Contracts\ComposerProxyContract;
use App\Facades\HttpClient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{

	protected $proxy;

	public function __construct(ComposerProxyContract $proxy)
	{
		$this->proxy = $proxy;
	}

	public function index()
	{
		$title = config('composer.title');

		return view('index', compact('title'));
	}

	public function packages($repo)
	{
		$path = '/';
		$file = 'packages.json';

		$response = $this->proxy->loadIgnoreLocalCache($this->makeUrl($repo, $path, $file), $this->makeLocalPath($repo, $path, $file));

		$content = json_decode($response, true);
		foreach (['notify', 'notify-batch', 'search'] as $key) {
			$content[$key] = config('composer.repository.' . $repo) . $content[$key];
		}
		$content['providers-url'] = '/' . $repo . $content['providers-url'];

		return JsonResponse::create($content);
	}

	public function provider($repo, $provider, $hash)
	{
		$path = "/p/";
		$file = $provider . "$" . $hash . ".json";

		return Response::create($this->proxy->load($this->makeUrl($repo, $path, $file), $this->makeLocalPath($repo, $path, $file)));
	}

	public function packageHashed($repo, $namespace, $package, $hash)
	{
		$path = "/p/" . $namespace . "/";
		$file = $package . "$" . $hash . ".json";

		return Response::create($this->proxy->load($this->makeUrl($repo, $path, $file), $this->makeLocalPath($repo, $path, $file)));
	}

	public function package($repo, $namespace, $package)
	{
		$path = "/p/" . $namespace . "/";
		$file = $package . ".json";

		return Response::create($this->proxy->load($this->makeUrl($repo, $path, $file), $this->makeLocalPath($repo, $path, $file)));
	}

	private function makeUrl($repo, $path, $file)
	{
		return config('composer.repository.' . $repo) . $path . $file;
	}

	private function makeLocalPath($repo, $path, $file)
	{
		return storage_path(config('composer.cache.dir')) . "/" . $repo . $path . $file;
	}

}
