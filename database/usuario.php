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
        $consulta = "SELECT * FROM usuario ORDER BY apellido1";
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

        $comando = "SELECT usuario.id,usuario.nombre,usuario.apellido1,usuario.apellido2,correo,departamento, 
            perfil.colaborador, perfil.jefe,perfil.RH from usuario, perfil
            where usuario.id = ? and usuario.contrasena = ? and usuario.perfil = perfil.id;";

        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($id, $contrasena));
            $user = $sentencia->fetch(PDO::FETCH_ASSOC);
            if ($user) {
                $response['id'] = $user['id'];
                $response['user']['id'] = $user['id'];
                $response['user']['nombre'] = $user['nombre'] . " " . $user['apellido1'] . " " . $user['apellido2'];
                $response['user']['correp'] = $user['correo'];
                $response['user']['perfil']['colaborador'] = $user['colaborador'];
                $response['user']['perfil']['jefe'] = $user['jefe'];
                $response['user']['perfil']['RH'] = $user['RH'];
                return $response;
            }
            return false;
        } catch (PDOException $pdoExcetion) {
            return false;
        }
    }

}
