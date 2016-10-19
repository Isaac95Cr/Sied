<?php

/**
 * @author Isaac Corrales Cruz <isakucorrales@gmail.com>
 * @author Marco Vinicio Cambronero Fonseca <marcovcambronero@gmail.com>
 */
require 'database.php';
require 'mensaje.php';

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

    public static function getAllFrom($id) {
        $consulta = "SELECT * FROM usuario where id = ?";
        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($id));
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function insert($id, $nombre, $apellido1, $apellido2, $correo, $contrasena, $departamento) {
        $comando = "INSERT INTO usuario ( " .
                "id, nombre," .
                " apellido1, apellido2," .
                " correo, contrasena,departamento)" .
                " VALUES( ?,?,?,?,?,?,? )";

        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($id, $nombre, $apellido1, $apellido2, $correo, $contrasena, $departamento));
            return new Mensaje("Exito", "<p>Se registró el usuario con exito :D</p>");
        } catch (PDOException $pdoExcetion) {
            return new Mensaje("Error", "<p>Error#" . $pdoExcetion->getCode() . "</p>");
        }
    }

    public static function login($id, $contrasena) {
        
        $newContrasena = md5($contrasena);
        
        $comando = "SELECT usuario.id,usuario.nombre,usuario.apellido1,usuario.apellido2,correo,departamento, 
            perfil.colaborador, perfil.jefe,perfil.RH from usuario, perfil
            where usuario.id = ? and usuario.contrasena = ? and usuario.perfil = perfil.id;";

        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($id, $newContrasena));
            $user = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $user;
        } catch (PDOException $pdoExcetion) {
            return false;
        }
    }

}
