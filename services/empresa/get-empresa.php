<?php

require '../../database/empresa.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $empresa = Empresa::getAll();
        $datos["estado"] = 1;
        $datos["empresa"] = $empresa;
        print json_encode($datos);
    
}