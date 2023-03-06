<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
    $request->attributes->add($matcher->match($request->getPathInfo()));

    

    $response = call_user_func($request->attributes->get('_controller'), $request);
} catch (Routing\Exception\ResourceNotFoundException $exception) {

    $response = new Response('Not Found', 404);
} catch (Exception $exception) {

    $response = new Response('An error occurred', 500);
}

$response->send();