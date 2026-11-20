<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// 1. Siapkan direktori writable di /tmp Vercel
$tmpPath = '/tmp';
$directories = [
    "$tmpPath/storage/app/public",
    "$tmpPath/storage/framework/cache/data",
    "$tmpPath/storage/framework/sessions",
    "$tmpPath/storage/framework/testing",
    "$tmpPath/storage/framework/views",
    "$tmpPath/storage/logs",
    "$tmpPath/bootstrap/cache",
];

foreach ($directories as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// 2. Arahkan cache bootstrap & view ke /tmp sebelum aplikasi dimuat
putenv("APP_SERVICES_CACHE=$tmpPath/bootstrap/cache/services.php");
putenv("APP_PACKAGES_CACHE=$tmpPath/bootstrap/cache/packages.php");
putenv("APP_CONFIG_CACHE=$tmpPath/bootstrap/cache/config.php");
putenv("APP_ROUTES_CACHE=$tmpPath/bootstrap/cache/routes.php");
putenv("VIEW_COMPILED_PATH=$tmpPath/storage/framework/views");

$_ENV['APP_SERVICES_CACHE'] = "$tmpPath/bootstrap/cache/services.php";
$_ENV['APP_PACKAGES_CACHE'] = "$tmpPath/bootstrap/cache/packages.php";
$_ENV['APP_CONFIG_CACHE'] = "$tmpPath/bootstrap/cache/config.php";
$_ENV['APP_ROUTES_CACHE'] = "$tmpPath/bootstrap/cache/routes.php";
$_ENV['VIEW_COMPILED_PATH'] = "$tmpPath/storage/framework/views";

// 3. Muat autoloader Composer
require __DIR__.'/../vendor/autoload.php';

// 4. Boot aplikasi dan arahkan storage path
$app = require_once __DIR__.'/../bootstrap/app.php';
$app->useStoragePath("$tmpPath/storage");

// 5. Jalankan request menggunakan metode resmi Laravel 11
$app->handleRequest(Request::capture());