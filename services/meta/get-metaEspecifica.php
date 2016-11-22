<?php

require '../../database/meta.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $body = json_decode(file_get_contents("php://input"), true);
    $meta = Meta::getAllFrom($body);
    $datos["estado"] = 1;
    $datos["metas"] = $meta;
    print json_encode($datos);
}
