<?php

return [
	'title'      => env('APP_TITLE', ''),
	// repository
	'default'    => env('REPOSITORY_DEFAULT', 'packagist'),
	'repository' => [
		'packagist' => env('REPOSITORY_PACKAGIST'),
		// add more repository...
	],
	// local cache
	'cache'      => [
		'dir' => env('CACHE_DIR', 'packages'),
	]
];