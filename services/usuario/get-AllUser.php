<?php
require '../../database/usuario.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $body = json_decode(file_get_contents("php://input"), true);
    $usuarios = Usuario::getTodaInformacionUser($body);
    $datos["estado"] = 1;
    $datos["usuario"] = $usuarios;
    print json_encode($datos);
}

