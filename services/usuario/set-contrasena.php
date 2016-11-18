<?php

require '../../database/usuario.php';
require '../jwt/JWT.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);
    $token = $body['token'];
    $user = $body['user'];
    $response = Usuario::validarToken($token);
    if ($response) {
        $contrasena = md5($user['contrasena']);
        $sign = JWT::getSign($token);
        Usuario::setContrasena($contrasena, $sign);
        Usuario::logout($token);
        print json_encode(array(
                            'mensaje' => "La contraseña se cambio con exito."));
    } else {
        print json_encode(array(
                            'mensaje' => "Ocurrio un error"));
    }
}

