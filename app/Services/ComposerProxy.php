<?php

namespace App\Services;

use App\Contracts\ComposerProxyContract;
use App\Traits\ComposerTrait;

class ComposerProxy implements ComposerProxyContract
{
	use ComposerTrait;

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
		$this->makeDirIfNeeded($localPath);
		$response = $this->loadFromRepository($url);
		$this->makeLocalCache($response, $localPath);

		return $response;
	}

}