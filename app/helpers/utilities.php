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
