<?php

require '../database/perfilCompetencia.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $perfil = perfilCompetencia::getAll();
    $datos["estado"] = 1;
    $datos["perfil"] = $perfil;
    print json_encode($datos);
}