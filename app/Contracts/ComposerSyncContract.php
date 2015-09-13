<?php

namespace App\Contracts;


interface ComposerSyncContract
{
	public function pull($url, $localPath);

	public function pullIgnoreLocalCache($url, $localPath);
}