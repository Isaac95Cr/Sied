<?php
require '../../database/notificacion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $body = json_decode(file_get_contents("php://input"), true);
    $id = $body['id'];
    $notificacion = Notificacion::update("1",$id);
    
    print json_encode($notificacion);
}
