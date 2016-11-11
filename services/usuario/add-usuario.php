<?php

require '../../database/usuario.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);
    $nombre = $body['nombre'];
    $id = $body['cedula'];
    $apellido1 = $body['apellido1'];
    $apellido2 = $body['apellido2'];
    $correo = $body['correo'];
    $contrasena = md5($body['contrasena']);
    $departamento = $body['departamento']['id'];
    $perfil =  Usuario::getPerfil($body['perfil']);
    if ($body['estado'] != null) {
        $estado = $body['estado'];
    } else {
        $estado = 0;
    }
    $retorno = Usuario::insert($id, $nombre, $apellido1, $apellido2, $correo, $estado, $contrasena, $departamento,$perfil);

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