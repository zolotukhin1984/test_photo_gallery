<?php

use App\Controllers\AuthController;
use App\Models\User;
use App\View;

require __DIR__ . '/autoload.php';

session_start();

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$parts = explode('/', $uri);

$ctrlName = $parts[1] ? ucfirst($parts[1]) : 'Auth';
$classController = '\App\Controllers\\' . $ctrlName . 'Controller';

$ctrl = new $classController();
$action = $parts[2] ? ucfirst($parts[2]) : 'Index';
$ctrl->action($action, $method);
