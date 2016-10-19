<?php
require '../../database/competencia.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);
    // Insertar meta
    $retorno = Competencia::delete($body['id']);

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

