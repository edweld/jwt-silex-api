<?php
/* Create the private and public key */
$res = openssl_pkey_new(array(
    "private_key_bits" => 2048,
    "private_key_type" => OPENSSL_KEYTYPE_RSA,
));

/* Extract the private key from $res to $privKey */
openssl_pkey_export($res, $privKey);

/* Extract the public key from $res to $pubKey */
$pubKey = openssl_pkey_get_details($res);
$pubKey = $pubKey["key"];

file_put_contents('./private.pem', $privKey);
file_put_contents('./public.pem', $pubKey);
?>
