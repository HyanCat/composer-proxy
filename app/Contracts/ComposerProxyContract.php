<?php

namespace App\Contracts;

interface ComposerProxyContract
{
	public function load($url, $localPath);

	public function loadIgnoreLocalCache($url, $localPath);
}