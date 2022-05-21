<?php

// $request = $_SERVER['REQUEST_URI'];
// $request = rtrim($request, '/');
// $base = (isset($_SERVER['HTTPS']) ? "https://" : "http://") . $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
// $loc = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

// require_once __DIR__ . '/helpers.php';


// composer autoload

use Routes\Router;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/database.php';

$router = new Router();

require_once __DIR__ . '/routes/web.php';

$router->make();
