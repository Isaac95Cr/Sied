<?php

require 'competencia.php';

class perfilCompetencia {

    public static function getAll() {
        $consulta = "SELECT * FROM perfil_competencia;";
        try {
            $json_response = array();
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute();
            $perfiles = $comando->fetchAll(PDO::FETCH_ASSOC);
            foreach ($perfiles as $row) {
                $newrow = array();
                $newrow['id'] = $row['id'];
                $newrow['nombre'] = $row['nombre'];
                $newrow['competencias'] = Competencia::getAllFrom($row['id']);
                array_push($json_response, $newrow);
            }
            return $json_response;
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function getAllFrom($id) {
        $consulta = "SELECT * FROM perfil_competencia where id = ?";
        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($id));
            $perfil = $comando->fetch(PDO::FETCH_ASSOC);
            $newrow['id'] = $perfil['id'];
            $newrow['nombre'] = $perfil['nombre'];
            $newrow['competencias'] = Competencia::getAllFrom($perfil['id']);
            return $newrow;
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function insert($nombre) {
        $comando = "INSERT INTO perfil_competencia (nombre) VALUES (?);";
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($nombre));
            return new Mensaje("Exito", "<p>Se agregó el perfil con exito :D</p>");
        } catch (PDOException $pdoExcetion) {
            return new Mensaje("Error", "<p>Error#" . $pdoExcetion->getCode() . "</p>");
        }
    }

    public static function update($nombre, $id) {
        $comando = "UPDATE perfil_competencia set nombre = ? where id = ?;";
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($nombre, $id));
            return new Mensaje("Exito", "<p>Se modificó el perfil de competencia con exito :D</p>");
        } catch (PDOException $pdoExcetion) {
            return new Mensaje("Error", "<p>Error#" . $pdoExcetion->getCode() . "</p>");
        }
    }

    public static function delete($id) {
        $comando = "DELETE FROM perfil_competencia WHERE id = ?;";
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($id));
            return new Mensaje("Exito", "<p>Se eliminó el perfil con exito :D</p>");
        } catch (PDOException $pdoExcetion) {
            return new Mensaje("Error", "<p>Error#" . $pdoExcetion->getCode() . "</p>");
        }
    }

    
    
    // Obtener perfil de competencia de un usuario en específico.
    public static function getPerfilCompetUser($id) {
        $consulta = "SELECT  perfil_competencia.id, perfil_competencia.nombre 
                                                FROM perfil_competencia, usuario, evaluacion_periodo
                                                WHERE usuario.id = ? AND
                                                evaluacion_periodo.usuario = usuario.id AND
                                                evaluacion_periodo.perfil_competencia = perfil_competencia.id;";
        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($id));
            $perfil = $comando->fetch(PDO::FETCH_ASSOC);
            $newrow['id'] = $perfil['id'];
            $newrow['nombre'] = $perfil['nombre'];
            return $newrow;
        } catch (PDOException $e) {
            return false;
        }
    }

}
