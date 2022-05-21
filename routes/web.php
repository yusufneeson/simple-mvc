<?php

use App\Controllers\HomeController;

$router->get('/', [HomeController::class, 'index']);
$router->get('/about', [HomeController::class, 'about']);
