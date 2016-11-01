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
        $consulta = "SELECT usuario.id,usuario.nombre,usuario.apellido1,usuario.apellido2,correo,departamento, (empresa.nombre) as empresa,
perfil.colaborador, perfil.jefe,perfil.RH from usuario, perfil,empresa,departamento where 
usuario.departamento = departamento.id 
and departamento.empresa = empresa.id 
and usuario.perfil = perfil.id;";
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
                $response['nombre'] = $user['nombre'] . " " . $user['apellido1'] . " " . $user['apellido2'];
                $response['correo'] = $user['correo'];
                $response['perfil']['colaborador'] = $user['colaborador'];
                $response['perfil']['jefe'] = $user['jefe'];
                $response['perfil']['RH'] = $user['RH'];
                return $response;
            }
            return false;
        } catch (PDOException $pdoExcetion) {
            return false;
        }
    }

    public static function token($user) {
        $key = "userSied";
        $token = array(
            "kid" => "1",
            "user" => $user
        );
        $jwt = JWT::encode($token, $key);
        try {
            $sign = JWT::getSign($jwt);
        } catch (Exception $e) {
            return null;
        }
        $comando = "UPDATE usuario SET token = ? WHERE id = ?;";

        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($sign, $user['id']));
        } catch (PDOException $pdoExcetion) {
            return new Mensaje("Error", "<p>Error:" . $pdoExcetion->getMessage() . "</p>");
        }
        return $jwt;
    }

    public static function logout($jwt) {
        $key = "userSied";
        try {
            $decoded = JWT::decode($jwt, $key, array('HS256'));
        } catch (Exception $e) {
            return null;
        }
        $comando = "UPDATE usuario SET token = null WHERE id = ?;";

        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($decoded->user->id));
        } catch (PDOException $pdoExcetion) {
            return new Mensaje("Error", "<p>Error:" . $pdoExcetion->getMessage() . "</p>");
        }
    }

    public static function validarToken($jwt) {
        $key = "userSied";
        try {
            $decoded = JWT::decode($jwt, $key, array('HS256'));
            $sign = JWT::getSign($jwt);
        } catch (Exception $e) {
            return false;
        }
        $comando = "select 1 from sied.usuario where token = ? ;";
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($sign));
            $result = $sentencia->fetch(PDO::FETCH_ASSOC);
            if (result) {
                return false;
            }
        } catch (PDOException $pdoExcetion) {
            return false;
        }
        return true;
    }

}
