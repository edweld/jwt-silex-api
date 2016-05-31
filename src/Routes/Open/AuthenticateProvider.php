<?php

namespace App\Routes\Open;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Firebase\JWT\JWT;

class AuthenticateProvider
{
    public function authenticate(Application $app, Request $request)
    {
	//application_id
        $username = $request->get('username');
        //application_auth_key
        $password = $request->get('password');
        //verify key was expected

        // check requesting uri??

        // ... some code

        if ($username == 'test' && $password == 'test') {
            $jsonObject = array(
                // Registered Claims
                "iss" => "ThisServiceId", // Claiming Issure
                "aud" => "http://ec2-54-229-162-109.eu-west-1.compute.amazonaws.com", // Intended Audience (requested uri)
                "iat" => time(), // Issued At Time
                "nbf" => time(), // Not Before Time
                "exp" => time()+60*60*24, // Expiration Time (24 hours)
                // Public Claims
                "payload" => [
                    "firstName" => "Test",
                    "lastName" => "Tester",
                    "title" => "Mr",
                    "admin" => true
                ]
            );

            // Get the secret key for signing the JWT from an environment variable
            $someSuperSecretKey = getenv('SomeSuperSecretKey');

            // If no environment variable is set, use this one.
            if(empty($someSuperSecretKey)) {
                $someSuperSecretKey = '123456789';
            }

            // Sign the JWT with the secret key
            $jsonWebToken = JWT::encode($jsonObject, $someSuperSecretKey );

            return $app->json([
                               'status' =>  1,
                               'message' => $jsonWebToken
                                ]);
        } else {

                return $app->json(['status' => 0,
                    'message' => 'Failed to Authenticate']);
            }

    }
}
