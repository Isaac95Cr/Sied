<?php
require '../database/usuario.php';
/*
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $usuario = Usuario::getAll();

    if ($usuario) {

        $datos["estado"] = 1;
        $datos["usuario"] = $usuario;
        print json_encode($datos);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Ha ocurrido un error"
        ));
    }
}*/
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);
    // Insertar meta
    $retorno = Usuario::insert(
        $body['id'],
        $body['nombre'],
        $body['apellido1'],
        $body['apellido2'],
        $body['correo'],
        $body['contrasena']);

    if ($retorno) {
        // Código de éxito
        print json_encode(
            array(
                'estado' => '1',
                'mensaje' => 'Creación exitosa'));
    } else {
        // Código de falla
        print json_encode(
            array(
                'estado' => '2',
                'mensaje' => 'Creación fallida')
        );
    }
}