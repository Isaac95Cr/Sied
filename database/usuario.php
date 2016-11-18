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
        $consulta = "SELECT usuario.id,usuario.nombre,usuario.apellido1,usuario.apellido2,correo,usuario.estado,"
                . "(departamento.nombre) as departamento, (empresa.nombre) as empresa,"
                . "perfil.colaborador, perfil.jefe,perfil.RH from usuario, perfil,empresa,departamento where "
                . "usuario.departamento = departamento.id "
                . "and departamento.empresa = empresa.id "
                . "and usuario.perfil = perfil.id;";
        try {

            $json_response = array();
            $perfiles = ['colaborador', 'jefe', 'RH'];
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute();
            $users = $comando->fetchAll(PDO::FETCH_ASSOC);
            foreach ($users as $user) {
                $response['id'] = $user['id'];
                $response['nombre'] = $user['nombre'];
                $response['apellido1'] = $user['apellido1'];
                $response['apellido2'] = $user['apellido2'];
                $response['correo'] = $user['correo'];
                $response['estado'] = $user['estado'];
                $response['departamento'] = $user['departamento'];
                $response['empresa'] = $user['empresa'];
                $response['perfil'] = array();
                $response['perfil']['Colaborador'] = $user['colaborador'];
                $response['perfil']['Jefe'] = $user['jefe'];
                $response['perfil']['RH'] = $user['RH'];
                /* foreach ($perfiles as $perfil){
                  if($user[$perfil]==1){
                  array_push($response['perfil'],$perfil);
                  }
                  } */
                array_push($json_response, $response);
            }
            return $json_response;
            //return $users;
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function getAllFrom($id) {
        $consulta = "SELECT usuario.id,usuario.nombre,usuario.apellido1,usuario.apellido2,correo,usuario.estado,"
                . "(departamento.nombre) as departamento, (empresa.nombre) as empresa,"
                . "perfil.colaborador, perfil.jefe,perfil.RH from usuario, perfil,empresa,departamento where "
                . "usuario.departamento = departamento.id "
                . "and departamento.empresa = empresa.id "
                . "and usuario.perfil = perfil.id and usuario.id = ?";
        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($id));
            $user = $comando->fetch(PDO::FETCH_ASSOC);
            $response['id'] = $user['id'];
            $response['nombre'] = $user['nombre'];
            $response['apellido1'] = $user['apellido1'];
            $response['apellido2'] = $user['apellido2'];
            $response['correo'] = $user['correo'];
            $response['estado'] = $user['estado'];
            $response['departamento'] = $user['departamento'];
            $response['empresa'] = $user['empresa'];
            $response['perfil'] = array();
            $response['perfil']['Colaborador'] = $user['colaborador'];
            $response['perfil']['Jefe'] = $user['jefe'];
            $response['perfil']['RH'] = $user['RH'];
            return $response;
        } catch (PDOException $e) {
            return false;
        }
    }
    
    
    
  public static function getTodaInformacionUser($id) {
        $consulta = "SELECT * FROM usuario where id = ?";
        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($id));
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
   }
    
    

    public static function insert($id, $nombre, $apellido1, $apellido2, $correo, $estado, $contrasena, $departamento, $perfil = "0") {
        $comando = "INSERT INTO usuario ( " .
                "id, nombre," .
                " apellido1, apellido2," .
                " correo,estado, contrasena,departamento,perfil)" .
                " VALUES( ?,?,?,?,?,b?,?,?,? )";

        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($id, $nombre, $apellido1, $apellido2, $correo, $estado, $contrasena, $departamento, $perfil));
            return new Mensaje("Exito", "<p>Se registró el usuario con exito :D</p>");
        } catch (PDOException $pdoExcetion) {
            return new Mensaje("Error", "<p>Error#" . $pdoExcetion->getCode() . "</p>");
        }
    }

    public static function update($id, $nombre, $apellido1, $apellido2, $correo, $estado, $departamento, $perfil = "0") {
        $comando = "UPDATE usuario set " .
                " nombre = ?," .
                " apellido1 = ?, apellido2 = ?," .
                " correo = ?,estado = b?, departamento = ?,perfil = ? where id = ?";

        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($nombre, $apellido1, $apellido2, $correo, $estado, $departamento, $perfil, $id));
            return new Mensaje("Exito", "<p>Se registró el usuario con exito :D</p>");
        } catch (PDOException $pdoExcetion) {
            return new Mensaje("Error", "<p>Error#" . $pdoExcetion->getCode() . "</p>");
        }
    }

    public static function existe($id) {

        $comando = "select 1 from sied.usuario where id = ? ;";
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($id));
            $result = $sentencia->fetch(PDO::FETCH_ASSOC);
            if (!$result) {
                return false;
            }
        } catch (PDOException $pdoExcetion) {
            return false;
        }
        return true;
    }
    
    public static function correo($id) {

        $comando = "select usuario.correo from sied.usuario where id = ? ;";
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($id));
            $result = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $result['correo'];
        } catch (PDOException $pdoExcetion) {
            return false;
        }
        return $result['correo'];
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
        $token = array(
            "user" => $user
        );
        $jwt = JWT::encode($token, KEY);
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
        try {
            $decoded = JWT::decode($jwt, KEY, array('HS256'));
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
        try {
            $decoded = JWT::decode($jwt, KEY, array('HS256'));
            $sign = JWT::getSign($jwt);
        } catch (Exception $e) {
            return false;
        }
        $comando = "select 1 from sied.usuario where token = ? ;";
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($sign));
            $result = $sentencia->fetch(PDO::FETCH_ASSOC);
            if (!$result) {
                return false;
            }
        } catch (PDOException $pdoExcetion) {
            return false;
        }
        return true;
    }

    public static function getPerfil($perfiles) {
        $perf = ["Colaborador" => 0, "Jefe" => 1, "RH" => 2];
        $x = [0, 0, 0];
        foreach ($perfiles as $perfil) {
            if ($perf[$perfil] !== null) {
                $x[$perf[$perfil]] = 1;
            } else {
                $x[$perf[$perfil]] = 0;
            }
        }
        $comando = "select id from perfil where perfil.colaborador = ? and perfil.jefe = ? and perfil.RH = ?;";

        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute($x);
            $result = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $result['id'];
        } catch (PDOException $pdoExcetion) {
            return 0;
        }
    }
    
    public static function setContrasena($contrasena,$token){
        $comando = "UPDATE usuario SET contrasena = ? WHERE token = ?;";

        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($contrasena,$token));
            
        } catch (PDOException $pdoExcetion) {
            return new Mensaje("Error", "<p>Error:" . $pdoExcetion->getMessage() . "</p>");
        }
    }
}
