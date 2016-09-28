<?php

 /**
  * @author Isaac Corrales Cruz <isakucorrales@gmail.com>
  * @author Marco Vinicio Cambronero Fonseca <marcovcambronero@gmail.com>
  */

require 'database.php';


/**
 *  Descripción de la clase...
 */

class Usuario {

    function __construct() {
        
    }

    public static function getAll() {
        $consulta = "SELECT * FROM usuario";
        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute();
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function insert($id, $nombre, $apellido1, $apellido2, $correo, $contrasena) {
        $comando = "INSERT INTO usuario ( " .
                "id, nombre," .
                " apellido1, apellido2," .
                " correo, contrasena)" .
                " VALUES( ?,?,?,?,?,? )";

        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute(array($id, $nombre, $apellido1, $apellido2, $correo, $contrasena));
    }

}
