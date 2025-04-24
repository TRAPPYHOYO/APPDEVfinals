<?php

<<<<<<< HEAD
use Illuminate\Foundation\Application;
=======
use Illuminate\Contracts\Http\Kernel;
>>>>>>> 5636c5d13ba2b4d9ccada4d832aebbe4053e63f7
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

<<<<<<< HEAD
// Check for maintenance mode
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Composer autoloader
require __DIR__.'/../vendor/autoload.php';

/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
=======
require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Kernel::class);
>>>>>>> 5636c5d13ba2b4d9ccada4d832aebbe4053e63f7

$response = $kernel->handle(
    $request = Request::capture()
)->send();

$kernel->terminate($request, $response);
