<?php

require '../../database/usuario.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);
    // Insertar meta
    $nombre = $body['nombre'];
    $id = $body['cedula'];
    $apellido1 = $body['apellido1'];
    $apellido2 = $body['apellido2'];
    $correo = $body['correo'];
    $contrasena = md5($body['contrasena']);
    $departamento = $body['departamento'];
    $retorno = Usuario::insert($id, $nombre, $apellido1, $apellido2, $correo, $contrasena, $departamento);

    if ($retorno instanceof Mensaje) {
        // Código de éxito
        print $retorno->json();
    } else {
        // Código de falla
        print json_encode(
                        array(
                            'titulo' => 'Error',
                            'mensaje' => "Error de conexión")
        );
    }
}