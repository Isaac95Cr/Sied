<?php

/**
 * @author Isaac Corrales Cruz <isakucorrales@gmail.com>
 * @author Marco Vinicio Cambronero Fonseca <marcovcambronero@gmail.com>
 */
require '../services/variable.php';

/**
 *  Descripción de la clase...
 */
class usuarioData {

    function __construct() {
        
    }

    public static function getAll() {
        $consulta = "SELECT usuario.id,usuario.nombre,usuario.apellido1,usuario.apellido2,correo,usuario.estado,
(departamento.nombre) as departamento, (empresa.nombre) as empresa,
perfil.colaborador, perfil.jefe,perfil.RH, evaluacion_periodo.perfil_competencia as perfilid,
 perfil_competencia.nombre as nombrePerfil
from usuario, perfil,empresa,departamento, perfil_competencia, evaluacion_periodo  inner join  (SELECT id as actual FROM periodo WHERE NOW() BETWEEN periodo.fechainicio AND periodo.fechafinal) as actual on evaluacion_periodo.periodo = actual 
where usuario.departamento = departamento.id 
and departamento.empresa = empresa.id 
and usuario.perfil = perfil.id 
and usuario.id = evaluacion_periodo.usuario
and evaluacion_periodo.perfil_competencia = perfil_competencia.id 
and perfil.id != 0;";
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
                $response['nombrePerfil'] = $user['nombrePerfil'];
                $response['perfilId'] = $user['perfilId'];
                array_push($json_response, $response);
            }
            return $json_response;
            //return $users;
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function getAllSolicitudes() {
        $consulta = "SELECT usuario.id,usuario.nombre,usuario.apellido1,usuario.apellido2,correo,usuario.estado,
(departamento.nombre) as departamento, (empresa.nombre) as empresa,
perfil.colaborador, perfil.jefe,perfil.RH from usuario, perfil,empresa,departamento where 
usuario.departamento = departamento.id 
and departamento.empresa = empresa.id 
and usuario.perfil = perfil.id
and perfil.id = 0;";
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
                array_push($json_response, $response);
            }
            return $json_response;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        return false;
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
            if ($user) {
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
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        return false;
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
            return true;
        } catch (PDOException $pdoExcetion) {
            return $pdoExcetion->getMessage();
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
            return true;
        } catch (PDOException $pdoExcetion) {
            return $pdoExcetion->getMessage();
        }
    }

    public static function updateEvaluacion($id, $periodo, $perfil) {
        $comando = "INSERT INTO
            evaluacion_periodo (usuario,periodo,perfil_competencia)
            VALUES (?,?,?)
            ON DUPLICATE KEY UPDATE  perfil_competencia = values(perfil_competencia);";

        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($id, $periodo, $perfil));
            return true;
        } catch (PDOException $pdoExcetion) {
            return $pdoExcetion->getMessage();
        }
    }

    public static function delete($id) {
        $comando = "DELETE FROM usuario WHERE id = ?;";

        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($id));
            return true;
        } catch (PDOException $pdoExcetion) {
            return $pdoExcetion->getMessage();
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
            return FALSE;
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
            perfil.colaborador, perfil.jefe,perfil.RH,usuario.estado from usuario, perfil
            where usuario.id = ? and usuario.contrasena = ? and usuario.perfil = perfil.id;";

        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($id, $contrasena));
            $user = $sentencia->fetch(PDO::FETCH_ASSOC);
            if ($user) {
                if ($user['estado'] != 1) {
                    throw new Exception("No se tienen permisos para ingresar");
                }
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
            return $pdoExcetion;
        } catch (Exception $excetion) {
            return $excetion;
        }
    }

    public static function token($user) {
        $token = array(
            "user" => $user
        );
        $jwt = JWT::encode($token, $GLOBALS['KEY']);
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
            $decoded = JWT::decode($jwt, $GLOBALS['KEY'], array('HS256'));
        } catch (Exception $e) {
            return $e->getMessage();
        }
        $comando = "UPDATE usuario SET token = null WHERE id = ?;";

        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($decoded->user->id));
            return true;
        } catch (PDOException $pdoExcetion) {
            return $pdoExcetion->getMessage();
        }
    }

    public static function validarToken($jwt) {
        try {
            $decoded = JWT::decode($jwt, $GLOBALS['KEY'], array('HS256'));
            $sign = JWT::getSign($jwt);
        } catch (Exception $e) {
            return $e->getMessage();
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
            return $pdoExcetion->getMessage();
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

    public static function setContrasena($contrasena, $token) {
        $comando = "UPDATE usuario SET contrasena = ? WHERE token = ?;";

        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($contrasena, $token));
        } catch (PDOException $pdoExcetion) {
            return $pdoExcetion->getMessage();
        }
    }

    public static function getUsersByDepartament($idDepartamento) {

        $comando = "SELECT id, nombre, apellido1, apellido2 FROM usuario where departamento = ?;";

        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($idDepartamento));
            $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $pdoExcetion) {
            return $pdoExcetion->getMessage();
        }
    }

}
