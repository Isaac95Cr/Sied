<?php
require '../../database/usuario.php';
require '../jwt/JWT.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $body = json_decode(file_get_contents("php://input"), true);
    $token = $body['token'];
    $response = Usuario::validarToken($token);
    print $response;
}