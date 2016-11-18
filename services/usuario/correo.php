<?php

require '../../database/usuario.php';
require '../jwt/JWT.php';
require '../PHPMailer/PHPMailerAutoload.php';
require '../PHPMailer/examples/gmail.phps';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $body = json_decode(file_get_contents("php://input"), true);
    $id = $body['id'];
    $user = Usuario::existe($id);
    if ($user) {
       $u = Usuario::getAllFrom($id);
       $token = Usuario::token($u);
       enviarCorreo($u,$token);
       print json_encode(array('mensaje' => "El correo se envio con exito"));
    } else {
        print json_encode(array(
                            'mensaje' => "La identificación usada no corresponde a la de ningun usuario"));
    }
}

