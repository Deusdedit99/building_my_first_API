<?php

require_once '../vendor/autoload.php';

use App\Routes\Routes;

$routes = new Routes();
$routes->handleRequest();
