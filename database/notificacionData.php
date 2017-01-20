<?php



class notificacionData {

    function __construct() {
        
    }

    public static function getAllFrom($id) {
        $consulta = "SELECT notifi_usuario.id,notificacion.titulo,notificacion.descripcion,notificacion.url,notifi_usuario.fecha,notifi_usuario.visto "
                ."FROM notifi_usuario, notificacion where notifi_usuario.usuario = ? and notifi_usuario.notificacion = notificacion.id order by id desc";
        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($id));
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public static function update($id, $visto = 1) {
        $comando = "UPDATE notifi_usuario set visto = b? where id = ?;";
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($visto,$id));
            return true;
        } catch (PDOException $pdoExcetion) {
            return $pdoExcetion->getMessage();
        }
    }
    public static function insert($notificacion,$usuario) {
        $comando = "INSERT INTO notifi_usuario ( " .
                "notificacion, usuario)" .
                " VALUES(?,?)";

        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($notificacion,$usuario));
            return true;
        } catch (PDOException $pdoExcetion) {
            return $pdoExcetion->getMessage();
        }
    }

}
