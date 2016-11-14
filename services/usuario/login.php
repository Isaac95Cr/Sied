<?php

require '../../database/usuario.php';
require '../jwt/JWT.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $body = json_decode(file_get_contents("php://input"), true);
    $id = $body['id'];
    $contrasena = md5($body['contrasena']);
    $user = Usuario::login($id, $contrasena);
    if ($user) {
        $token = Usuario::token($user);
        echo $token;
    } else {
        echo "undefined";
    }
}