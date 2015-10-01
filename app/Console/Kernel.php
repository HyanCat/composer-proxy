<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		Commands\ComposerSync::class,
		Commands\CleanCache::class,
	];

	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule)
	{
		date_default_timezone_set(config('app.timezone'));
		$schedule->command('composer:sync')->everyThirtyMinutes()->sendOutputTo(storage_path('logs') . '/composer_' . date('Ymd_hi') . '.log');
	}
}
