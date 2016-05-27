<?php

$app['debug'] = true;
#define app configuration here?
$app['config'] = [];
#register DBAL service provider
$app->register(new Silex\Provider\DoctrineServiceProvider(), array('db.options' => [
                'driver'    => 'pdo_mysql',
                'host'      => '127.0.0.1',
                'dbname'    => 'bac',
                'dbnameuser' => 'root',
                'user'      => 'root',
                'password'  => '',
                'charset'  =>   'utf8'
            ]));
return $app;
