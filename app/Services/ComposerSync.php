<?php

namespace App\Services;

use App\Contracts\ComposerSyncContract;
use App\Traits\ComposerTrait;

class ComposerSync implements ComposerSyncContract
{
	use ComposerTrait;

	public function pull($url, $localPath)
	{
		$cache = $this->checkLocalCache($localPath);
		if (false === $cache) {
			$response = $this->loadFromRepository($url);
			$this->makeLocalCache($response, $localPath);

			return $response;
		}

		return false;
	}

	public function pullIgnoreLocalCache($url, $localPath)
	{
		$this->makeDirIfNeeded($localPath);
		$response = $this->loadFromRepository($url);
		$this->makeLocalCache($response, $localPath);

		return $response;
	}


}