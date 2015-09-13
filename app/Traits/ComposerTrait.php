<?php

namespace App\Traits;

use App\Facades\HttpClient;

trait ComposerTrait
{
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