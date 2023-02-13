<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Route;



$templatePath = __DIR__.'/../views/';
$routes = new RouteCollection();

$request = Request::createFromGlobals();
$requestUri = $request->getRequestUri();

$callback = function() {
    require $templatePath . 'home.html';
};

// $routes->add('home', new Route('/'));
// $routes->add('bye', new Route('/bye'));
