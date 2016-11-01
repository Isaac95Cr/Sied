<?php

require '../../database/meta.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $meta = Meta::getAll_Metas();
    $datos["estado"] = 1;
    $datos["meta"] = $meta;
    print json_encode($datos);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $body = json_decode(file_get_contents("php://input"), true);
    $meta = Meta::getMetas_User($body['id']);
    $datos["estado"] = 1;
    $datos["metas"] = $meta;
    print json_encode($datos);
}


