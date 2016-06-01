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

            /** 
             * Simple encryption, comment out below
               $key = '123456789qwerty'; 
               $jsonWebToken = JWT::encode($jsonObject, $key );
             */

	    /**
	     * RSA encryption
             */
            $key = openssl_pkey_get_private('file://'.dirname(__FILE__).'/../../../certs/private.pem'); 
            // Sign the JWT with the secret key
	    // @TODO refactor JWT to use phpseclib
            $jsonWebToken = JWT::encode($jsonObject, $key , 'RS256');
            openssl_free_key($key); 

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
