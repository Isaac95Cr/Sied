<?php
require '../database/departamento.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $departamento = Departamento::getAll();
        $datos["estado"] = 1;
        $datos["departamento"] = $departamento;
        print json_encode($datos);
    
}
