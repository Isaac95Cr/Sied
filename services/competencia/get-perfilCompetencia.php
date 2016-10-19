<?php

require '../../database/perfilCompetencia.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $perfiles = perfilCompetencia::getAll();
    $datos["estado"] = 1;
    $datos["perfiles"] = $perfiles;
    print json_encode($datos);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $body = json_decode(file_get_contents("php://input"), true);
    $perfil = perfilCompetencia::getAllFrom($body['id']);
    $datos["estado"] = 1;
    $datos["perfil"] = $perfil;
    print json_encode($datos);
}