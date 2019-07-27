<?php



$name = $_POST['name'];
$private = openssl_pkey_get_private(file_get_contents("./private.pem"));
openssl_private_decrypt(base64_decode($name), $decrypted,$private ,OPENSSL_PKCS1_PADDING);
var_dump($decrypted);
