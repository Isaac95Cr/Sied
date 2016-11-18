<?php
require '../../database/usuario.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $usuarios = Usuario::getAll();
    $datos["estado"] = 1;
    $datos["usuarios"] = $usuarios;
    print json_encode($datos);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $body = json_decode(file_get_contents("php://input"), true);
    $usuarios = Usuario::getAllFrom($body);
    $datos["estado"] = 1;
    $datos["usuario"] = $usuarios;
    print json_encode($datos);
}