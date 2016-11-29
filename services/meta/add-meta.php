<?php

 /**
  * @author Isaac Corrales Cruz <isakucorrales@gmail.com>
  * @author Marco Vinicio Cambronero Fonseca <marcovcambronero@gmail.com>
  */


require '../../database/meta.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);
    // Insertar meta
    $retorno = Meta::insert_Meta(
            $body['is_Evaluable'],
            $body['peso'],
            $body['titulo'],
            $body['descripcion'],
            $body['usuario']
     );

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
