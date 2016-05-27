<?php
##Testing
#curl http://ec2-54-229-162-109.eu-west-1.compute.amazonaws.com/api/ --header "Authorization: Bearer $(curl -s "http://ec2-54-229-162-109.eu-west-1.compute.amazonaws.com/authenticate?username=test&password=test" | grep -Po '"message":(.*?[^\\])"' | awk -F'"' '{print $4}')";
#key for auth token
putenv('SomeSuperSecretKey=z5YHXvl7l4perv25A0ZJno5r316850M4');

require_once __DIR__.'/../vendor/autoload.php';
$app = new Silex\Application();
require __DIR__.'/../src/app.php';
require __DIR__.'/../src/controllers.php';

$app->run();
