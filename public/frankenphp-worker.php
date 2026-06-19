<?php

declare(strict_types=1);

// Set a default for the application base path and public path if they are missing...
$_SERVER['APP_BASE_PATH'] = \Illuminate\Support\Env::get('APP_BASE_PATH', $_SERVER['APP_BASE_PATH'] ?? __DIR__.'/..');
$_SERVER['APP_PUBLIC_PATH'] = \Illuminate\Support\Env::get('APP_PUBLIC_PATH', $_SERVER['APP_PUBLIC_PATH'] ?? __DIR__);

require __DIR__.'/../vendor/laravel/octane/bin/frankenphp-worker.php';
