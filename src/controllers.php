<?php

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Routes\Closed\ApiRouteProvider;
use App\Routes\Open\RootRouteProvider;

$app->mount('/', new RootRouteProvider);
$app->mount('/api', new ApiRouteProvider);
$app->match('/authenticate', "App\Routes\Open\AuthenticateProvider::authenticate");

$app->error(function (\Exception $e, $code) {
    switch ($code) {
        case 404:
            $message = 'The requested page could not be found.';
            break;
        default:
            $message = "We are sorry, but something went terribly wrong. $e";
    }
    return new Response($message, $code);
});

return $app;
