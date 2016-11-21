<?php

require 'database.php';
require 'mensaje.php';

class Notificacion {

    function __construct() {
        
    }

    public static function getAll() {
        $consulta = "SELECT notificacion.id,notificacion.titulo,notificacion.descripcion,notificacion.url,notifi_usuario.fecha,notifi_usuario.visto "
                ."FROM notifi_usuario, notificacion where notifi_usuario.usuario = '123' and notifi_usuario.notificacion = notificacion.id";
        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute();
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

}
