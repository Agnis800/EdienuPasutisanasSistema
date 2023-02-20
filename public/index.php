<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\Response;
use Symfony\Component\Routing\Exception;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;

$templatePath = __DIR__.'/../views/';



$request = Request::createFromGlobals();
$routes = require __DIR__.'/../routes.php';





$context = new RequestContext();
$context->fromRequest($request);
$matcher = new UrlMatcher($routes, $context);

$attributes = $matcher->match($request->getPathInfo());

try {
    extract($matcher->match($request->getPathInfo()), EXTR_SKIP);
    ob_start();
    include sprintf($templatePath . '%s.html', $_route);

    $response = new Response(ob_get_clean());
} catch (Routing\Exception\ResourceNotFoundException $exception) {

    $response = new Response('Not Found', 404);
} catch (Exception $exception) {

    $response = new Response('An error occurred', 500);
}

$response->send();