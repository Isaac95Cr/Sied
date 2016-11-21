<?php
require '../../database/notificacion.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $notificacion = Notificacion::getAll();
    $datos["notificacion"] = $notificacion;
    print json_encode($datos);
}
