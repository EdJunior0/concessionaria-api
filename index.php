<?php

use src\Router;

require_once 'vendor/autoload.php';

$url = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
var_dump($url);
$method = $_SERVER['REQUEST_METHOD'];
$json = file_get_contents('php://input');
header('Content-type: application/json');
$router = new Router($url[3], json_decode($json, true), $method);
$router->start();
