<?php

use Illuminate\Http\Request;

// $allowedPages = [
//     'dashboard' => 'dashboard.php',
//     'home' => 'home.php',
//     'login' => 'login.php'
// ];
//
// $pageDestination = $_GET['page'] ?? 'dashboard';
//
// $destination = $allowedPages[$pageDestination] ?? '404.php';
//
//composer autoloader
require __DIR__ . '/../vendor/autoload.php';
// app autoloader
$app = require_once __DIR__ . '/../bootstrap/app.php';
// http request
$response = $app->handleRequest(Request::capture());

