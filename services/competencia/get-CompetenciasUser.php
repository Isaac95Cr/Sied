<?php

require '../../database/competencia.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $body = json_decode(file_get_contents("php://input"), true);
    $competencia = Competencia::getCompetUser($body['id']);
    $datos["estado"] = 1;
    $datos["competencias"] = $competencia;
    print json_encode($datos);
}

