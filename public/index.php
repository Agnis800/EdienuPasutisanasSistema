<?php

$requestUri = $_SERVER['REQUEST_URI'];
$templatePath = __DIR__.'/../views/';

switch ($requestUri) {
    case '/':
        require $templatePath . 'home.html';
        break;
    case '/pica':
        echo "i equals 1";
        break;
    case 2:
        echo "i equals 2";
        break;
    default:
        echo 'Nothing was found!';
}