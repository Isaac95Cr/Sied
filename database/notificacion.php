<?php

require 'database.php';
require 'mensaje.php';

class Notificacion {

    function __construct() {
        
    }

    public static function getAll() {
        $consulta = "SELECT notifi_usuario.id,notificacion.titulo,notificacion.descripcion,notificacion.url,notifi_usuario.fecha,notifi_usuario.visto "
                ."FROM notifi_usuario, notificacion where notifi_usuario.usuario = '123' and notifi_usuario.notificacion = notificacion.id";
        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute();
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
    public static function update($visto,$id) {
        $comando = "UPDATE notifi_usuario set visto = b? where id = ?;";
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($visto,$id));
            return new Mensaje("Exito", "<p>Se modificó la notificacion con exito :D</p>");
        } catch (PDOException $pdoExcetion) {
            return new Mensaje("Error", "<p>Error#" . $pdoExcetion->getCode() . "</p>");
        }
    }

}
