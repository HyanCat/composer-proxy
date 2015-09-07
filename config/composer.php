<?php

return [
	'title'      => env('APP_TITLE', ''),
	'repository' => [
		'packagist' => env('REPOSITORY_PACKAGIST'),
	],
	'cache'      => [
		'dir' => env('CACHE_DIR', 'storage/packages'),
	]
];