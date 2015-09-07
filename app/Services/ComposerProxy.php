<?php

namespace App\Services;

use App\Contracts\ComposerProxyContract;
use App\Facades\HttpClient;

class ComposerProxy implements ComposerProxyContract
{
	public function load($url, $localPath)
	{
		$cache = $this->checkLocalCache($localPath);
		if (false === $cache) {
			$response = $this->loadFromRepository($url);
			$this->makeLocalCache($response, $localPath);

			return $response;
		}

		return $cache;
	}

	public function loadIgnoreLocalCache($url, $localPath)
	{
		$response = $this->loadFromRepository($url);
		$this->makeLocalCache($response, $localPath);

		return $response;
	}

	private function loadFromRepository($url)
	{
		$response = HttpClient::get($url);
		if (! $response->isOk()) {
			abort($response->getStatusCode(), "Response Error!");
		}

		return $response->getContent();
	}

	private function checkLocalCache($localPath)
	{
		$this->makeDirIfNeeded($localPath);

		return file_exists($localPath) ? file_get_contents($localPath) : false;
	}

	private function makeLocalCache($content, $filePath)
	{
		file_put_contents($filePath, $content);
	}

	private function makeDirIfNeeded($filePath)
	{
		$dir = dirname($filePath);
		if (! is_dir($dir)) {
			@mkdir($dir, 0777, true);
		}
	}
}