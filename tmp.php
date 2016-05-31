<?php
//data you want to sign
//encrypt 
$data = '{"app_id":"123-456-678", "rid":"request_id"}';

//send to HSM - generate new key

//recieve '{app_id, request, signature_for_request} //signature of sign

//send to api decrypted 

// encrypt and check with hsm (app_id, request, signature }

//create new private and public key
$private_key_res = openssl_pkey_new(array(
    "private_key_bits" => 2048,
    "private_key_type" => OPENSSL_KEYTYPE_RSA,
));
$details = openssl_pkey_get_details($private_key_res);
$public_key_res = openssl_pkey_get_public($details['key']);

//create signature
openssl_sign($data, $signature, $private_key_res, "sha1WithRSAEncryption");
//echo base64_encode($signature);

openssl_private_encrypt($data, $crypted, $private_key_res);

//echo base64_encode($crypted);
$data = 'something';
//verify signature
$ok = openssl_verify($data, $signature, $public_key_res, OPENSSL_ALGO_SHA1);
if ($ok == 1) {
    echo "valid";
} elseif ($ok == 0) {
    echo "invalid";
} else {
    echo "error: ".openssl_error_string();
}
?>
