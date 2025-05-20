<?php

// Funcion para recuperar imagenes
function getClientImage($id)
{
    $webpPath = "app/uploads/dishes/$id.webp";

    if (file_exists($webpPath)) {
        $base64Image = 'data:image/webp;base64,' . base64_encode(file_get_contents($webpPath));
    } else {
        $base64Image = "default.webp";
    }

    return $base64Image;
}



function encryptPassword($password ) {
    $key = 'paquito69';
    $ivlen = openssl_cipher_iv_length($cipher = "AES-256-CBC");
    $iv = openssl_random_pseudo_bytes($ivlen);
    $encrypted = openssl_encrypt($password, $cipher, $key, OPENSSL_RAW_DATA, $iv);
    return base64_encode($iv . $encrypted);
}

function decryptPassword($encryptedPassword) {
    $key = 'paquito69';
    $c = base64_decode($encryptedPassword);
    $ivlen = openssl_cipher_iv_length($cipher = "AES-256-CBC");
    $iv = substr($c, 0, $ivlen);
    $encrypted = substr($c, $ivlen);
    return openssl_decrypt($encrypted, $cipher, $key, OPENSSL_RAW_DATA, $iv);
}