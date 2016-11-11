<?php

require '../../database/evalCompetencia.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $body = json_decode(file_get_contents("php://input"), true);
    $autoEvaluaciones = evaluacion_Competencia::getAutoEvCompetUser($body['id']);
    $datos["estado"] = 1;
    $datos["autoEvaluaciones"] = $autoEvaluaciones;
    print json_encode($datos);
}

