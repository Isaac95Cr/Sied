<?php

require 'competenciaData.php';

class perfilCompetenciaData {

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
                $newrow['competencias'] = competenciaData::getAllFrom($row['id']);
                array_push($json_response, $newrow);
            }
            return $json_response;
        } catch (PDOException $e) {
            return $e->getMessage();
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
            $newrow['competencias'] = competenciaData::getAllFrom($perfil['id']);
            return $newrow;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function insert($nombre) {
        $comando = "INSERT INTO perfil_competencia (nombre) VALUES (?);";
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($nombre));
            return true;
        } catch (PDOException $pdoExcetion) {
            return $pdoExcetion->getMessage();
        }
    }

    public static function update($nombre, $id) {
        $comando = "UPDATE perfil_competencia set nombre = ? where id = ?;";
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($nombre, $id));
            return true;
        } catch (PDOException $pdoExcetion) {
            return $pdoExcetion->getMessage();
        }
    }

    public static function delete($id) {
        $comando = "DELETE FROM perfil_competencia WHERE id = ?;";
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($id));
            return true;
        } catch (PDOException $pdoExcetion) {
            return $pdoExcetion->getMessage();
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
