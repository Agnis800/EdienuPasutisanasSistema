<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\ErrorHandler\Debug;


$templatePath = __DIR__.'/../views/';

Debug::enable();
$request = Request::createFromGlobals();
$routes = require __DIR__.'/../routes.php';


$context = new RequestContext();
$context->fromRequest($request);
$matcher = new UrlMatcher($routes, $context);

$attributes = $matcher->match($request->getPathInfo());

function render_template(Request $request, $templateFile)
{
    extract($request->attributes->all(), EXTR_SKIP);
    ob_start();
    include sprintf(__DIR__.'/../views/' . $templateFile, $_route);

    return new Response(ob_get_clean());
}

try {
    $request->attributes->add($matcher->match($request->getPathInfo()));
    $response = call_user_func($request->attributes->get('_controller'), $request);
} catch (Routing\Exception\ResourceNotFoundException $exception) {

    $response = new Response('Not Found', 404);
} catch (Exception $exception) {

    $response = new Response('An error occurred', 500);
}

$response->send();