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
    $id= $body['id'];
    $usuarios = Usuario::getAllFrom($id);
    $datos["estado"] = 1;
    $datos["usuarios"] = $usuarios;
    print json_encode($datos);
}