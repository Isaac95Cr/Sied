<?php
require '../database/departamento.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);
    // Insertar meta
    $retorno = Departamento::delete($body['id']);

    if ($retorno) {
        // Código de éxito
        print json_encode(
                        array(
                            'estado' => '1',
                            'mensaje' => 'Eliminar exitoso'));
    } else {
        // Código de falla
        print json_encode(
                        array(
                            'estado' => '2',
                            'mensaje' => 'Eliminar fallido')
        );
    }
}

