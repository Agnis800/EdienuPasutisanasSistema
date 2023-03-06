<?php

require_once __DIR__.'/vendor/autoload.php';

use App\Controller\ContactController;
use App\Controller\HomeController;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$routes = new RouteCollection();

// Define your routes here
$routes->add('home', new Route('/', [
    '_controller' => [new HomeController(), 'homeAction'],
]));
$routes->add('login', new Route('/login'));
$routes->add('register', new Route('/register'));
$routes->add('cart', new Route('/cart'));
$routes->add('contactform', new Route('/contactform',[
    '_controller' => [new ContactController(), 'contactAction'],
]));

return $routes;