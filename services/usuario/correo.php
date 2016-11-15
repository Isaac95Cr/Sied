<?php

require '../../database/usuario.php';
require '../jwt/JWT.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $body = json_decode(file_get_contents("php://input"), true);
    $id = $body['id'];
    $user = Usuario::existe($id);
    if ($user) {
       $correo = Usuario::correo($id);
       
    } else {
        echo "La identificación usada no corresponde a la de ningun usuario";
    }
}

