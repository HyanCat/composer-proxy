<?php

namespace App\Traits;

trait ComposerConfigTrait
{
	private function makeUrl($repo, $path, $file)
	{
		return config('composer.repository.' . $repo) . $path . $file;
	}

	private function makeLocalPath($repo, $path, $file)
	{
		return storage_path(config('composer.cache.dir')) . "/" . $repo . $path . $file;
	}
}