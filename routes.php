<?php

require_once __DIR__.'/vendor/autoload.php';

use App\Controller\ContactController;
use App\Controller\HomeController;
use App\Controller\LoginController;
use App\Controller\RegisterController;
use App\Controller\CartController;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$routes = new RouteCollection();

// Define your routes here
$routes->add('home', new Route('/', [
    '_controller' => [new HomeController(), 'homeAction'],
]));

$routes->add('login', new Route('/login', [
    '_controller' => [new LoginController(), 'loginAction'],
]));

$routes->add('register', new Route('/register', [
    '_controller' => [new RegisterController(), 'registerAction'],
]));

$routes->add('cart', new Route('/cart', [
    '_controller' => [new CartController(), 'cartAction'],
]));

$routes->add('contactform', new Route('/contactform',[
    '_controller' => [new ContactController(), 'contactAction'],
]));

return $routes;