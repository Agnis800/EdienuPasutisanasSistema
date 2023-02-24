<?php

require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$routes = new RouteCollection();

// Define your routes here
$routes->add('home', new Route('/'));
$routes->add('login', new Route('/login'));
// $routes->add('about', new Route('/about'));

return $routes;