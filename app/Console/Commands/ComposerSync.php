<?php

namespace App\Console\Commands;

use App\Contracts\ComposerSyncContract;
use App\Traits\ComposerConfigTrait;
use Illuminate\Console\Command;

class ComposerSync extends Command
{
	protected $name = 'composer:sync';

	protected $description = 'Synchronize composer packagist.';

	private $repo;

	protected $sync;

	use ComposerConfigTrait;

	public function __construct(ComposerSyncContract $sync)
	{
		parent::__construct();

		$this->repo = config('composer.default');
		$this->sync = $sync;
	}

	public function handle()
	{
		$url   = $this->makeUrl($this->repo, '/', 'packages.json');
		$local = $this->makeLocalPath($this->repo, '/', 'packages.json');
		$this->info('pulling: ' . $url);
		$packagesResponse = $this->sync->pullIgnoreLocalCache($url, $local);
		$this->info('writting: ' . $local);
		foreach (json_decode($packagesResponse)->{'provider-includes'} as $providerFormat => $hashArray) {
			$pathAndFile = str_replace('%hash%', $hashArray->sha256, $providerFormat);
			$url         = $this->makeUrl($this->repo, '/', $pathAndFile);
			$local       = $this->makeLocalPath($this->repo, '/', $pathAndFile);
			$this->info('pulling: ' . $url);
			$providerResponse = $this->sync->pullIgnoreLocalCache($url, $local);
			$this->info('writting: ' . $local);
			foreach (json_decode($providerResponse)->providers as $package => $hashArray) {
				$pathAndFile = sprintf('p/%s$%s.json', $package, $hashArray->sha256);
				$url         = $this->makeUrl($this->repo, '/', $pathAndFile);
				$local       = $this->makeLocalPath($this->repo, '/', $pathAndFile);
				$this->info('pulling: ' . $url);
				$packageResponse = $this->sync->pull($url, $local);
				if ($packageResponse === false) {
					$this->info('Checked exist and over.');
					continue;
				}
				$this->info('writting: ' . $local);
			};
		}
	}

}