<?php

use src\Router;

require_once 'vendor/autoload.php';

$url = parse_url($_SERVER['REQUEST_URI']);
// var_dump($url['path']);
$method = $_SERVER['REQUEST_METHOD'];
$json = file_get_contents('php://input');
header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Max-Age: 86400');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PATCH, DELETE");
header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
header('Content-type: application/json');
$router = new Router($url, json_decode($json, true), $method);
$router->start();
