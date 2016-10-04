<?php
require '../database/detalleCompetencia.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $detalle = DetalleCompetencia::getFrom(1);
        $datos["estado"] = 1;
        $datos["detalle"] = $detalle;
        print json_encode($datos);
    
}
