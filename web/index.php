<?php
##Testing
#key for auth token
putenv('SomeSuperSecretKey=z5YHXvl7l4perv25A0ZJno5r316850M4');

require_once __DIR__.'/../vendor/autoload.php';
$app = new Silex\Application();
require __DIR__.'/../src/app.php';
require __DIR__.'/../src/controllers.php';

$app->run();
