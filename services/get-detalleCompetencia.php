<?php

require '../database/detalleCompetencia.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $detalle = DetalleCompetencia::getAll();
    $datos["estado"] = 1;
    $datos["detalle"] = $detalle;
    print json_encode($datos);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $body = json_decode(file_get_contents("php://input"), true);
    $detalle = DetalleCompetencia::getAllFrom($body['id']);
    $datos["estado"] = 1;
    $datos["detalle"] = $detalle;
    print json_encode($datos);
}
