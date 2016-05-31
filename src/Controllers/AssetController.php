<?php
namespace App\Controllers;


use Silex\Application;
use Silex\ControllerProviderInterface; 
use Symfony\Component\HttpFoundation\Request;

class AssetController implements ControllerProviderInterface {

    private $app;

    public function connect( Application $app){
       //...
    }
    public function listAction(Request $request, Application $app){
        //... get some data
        return $app->json([ 'status'    =>  1, 'message'   => 'LIST'.json_encode($app['payload'])]); 
    }
    public function findAction(Request $request, Application $app){
        return $app->json([ 'status'    =>  1, 'message'   => json_encode($app['payload'])]); 
    }
    public function addAction(Request $request, Application $app){
        return $app->json([ 'status'    =>  1, 'message'   => json_encode($app['payload'])]); 
    }
    public function updateAction(Request $request, Application $app){
        return $app->json([ 'status'    =>  1, 'message'   => json_encode($app['payload'])]); 
    }
    public function removeAction(Request $request, Application $app){
        return $app->json([ 'status'    =>  1, 'message'   => 'REMOVE' . json_encode($app['payload'])]); 
    }
}
