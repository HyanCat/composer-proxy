<?php
/**
 * CleanCache.php
 * composer-proxy
 *
 * Created by HyanCat on 15/10/1.
 * Copyright (C) 2015 HyanCat. All rights reserved.
 */
namespace App\Console\Commands;


use App\Contracts\ComposerSyncContract;
use App\Traits\ComposerConfigTrait;
use Illuminate\Console\Command;

class CleanCache extends Command
{
	protected $signature = 'composer:clean {--all}';

	protected $description = 'Clean the cached packages.';

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
		$allFiles    = $this->findAllFiles();
		$removeFiles = [];
		foreach ($allFiles as $file) {
			$removeFiles[$file] = true;
		}

		$local               = $this->makeLocalPath($this->repo, '/', 'packages.json');
		$localContent        = file_get_contents($local);
		$removeFiles[$local] = false;

		foreach (json_decode($localContent)->{'provider-includes'} as $providerFormat => $hashArray) {
			$pathAndFile         = str_replace('%hash%', $hashArray->sha256, $providerFormat);
			$local               = $this->makeLocalPath($this->repo, '/', $pathAndFile);
			$removeFiles[$local] = false;
			if (! file_exists($local)) {
				continue;
			}
			$localContent = file_get_contents($local);

			foreach (json_decode($localContent)->providers as $package => $hashArray) {
				$pathAndFile         = sprintf('p/%s$%s.json', $package, $hashArray->sha256);
				$local               = $this->makeLocalPath($this->repo, '/', $pathAndFile);
				$removeFiles[$local] = false;
			};
		}

		foreach ($removeFiles as $file => $value) {
			if ($value === true) {
				$this->removeFile($file);
				$this->info('removed file: ' . $file);
			}
		}
	}

	private function findAllFiles()
	{
		$folder = storage_path(config('composer.cache.dir')) . "/" . $this->repo;
		exec("find $folder -name '*.json'", $output);

		return $output;
	}

	private function removeFile($file)
	{
		$file = str_replace('$', '\$', $file);
		exec("rm $file", $output);
	}
}