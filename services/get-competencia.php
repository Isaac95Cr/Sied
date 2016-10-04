<?php
require '../database/competencia.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $competencia = Competencia::getAll();
        $datos["estado"] = 1;
        $datos["competencia"] = $competencia;
        print json_encode($datos);
    
}
