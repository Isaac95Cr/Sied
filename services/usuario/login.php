<?php

require '../../database/usuario.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $body = json_decode(file_get_contents("php://input"), true);
    $id = $body['id'];
    $contrasena = md5($body['contrasena']);
    $retorno = Usuario::login($id,$contrasena);
    print json_encode($retorno);
    
}