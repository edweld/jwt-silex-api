<?php

namespace App\Routes\Closed;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Firebase\JWT\JWT;

class ApiRouteProvider implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $route = $app['controllers_factory'];
        //mount authentication to route Provider
        $route->before(function (Request $request) use ($app) {

            // Strip out the bearer
            $rawHeader = $request->headers->get('Authorization');
            if (strpos($rawHeader, 'Bearer ') === false) {
                return new Response('Unauthorized', 401);
            }

            $headerWithoutBearer = str_replace('Bearer ', '', $rawHeader);

            // Get the secret key for signing the JWT from an environment variable
            $someSuperSecretKey = getenv('SomeSuperSecretKey');

            // If no environment variable is set, use this one. -- should probably barf here
            if(empty($someSuperSecretKey)) {
                $someSuperSecretKey = '123456789';
            }

            try {
                $decodedJWT = JWT::decode($headerWithoutBearer, $someSuperSecretKey, ['HS256']);
            }  catch (Exception $e) {
                return new Response('Unauthorized', 401);
            }

            $app['payload'] = $decodedJWT->payload;
        });

        $route->get('/', function () use ($app) {
            return $app->json([
                                'status'    =>  1,
                                'message'   => json_encode($app['payload'])
            ]);
        });
        $route->get('/asset/list','App\\Controllers\\AssetController::listAction');
        $route->get('/asset/find','App\\Controllers\\AssetController::findAction');
        $route->get('/asset/add','App\\Controllers\\AssetController::addAction');
        $route->get('/asset/update','App\\Controllers\\AssetController::updateAction');
        $route->get('/asset/remove','App\\Controllers\\AssetController::removeAction');

        $route->get('/site','App\\Controllers\\SiteController::indexAction');
        $route->get('/proposal','App\\Controllers\\ProposalController::indexAction');
        // ... Blah Blah
        return $route;
    }
}
