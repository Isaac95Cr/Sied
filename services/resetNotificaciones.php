<?php

include '../database/database.php';
$consulta = "TRUNCATE TABLE notifi_usuario";
try {
    $comando = Database::getInstance()->getDb()->prepare($consulta);
    $comando->execute();
} catch (PDOException $e) {
    echo $e->getMessage();
}