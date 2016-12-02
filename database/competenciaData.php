<?php

require 'detalleCompetenciaData.php';

class competenciaData {

    public static function getAll() {
        $consulta = "SELECT * FROM competencia;";
        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute();
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function getAllFrom($perfil) {
        $consulta = "SELECT * FROM competencia where perfil = ?;";
        try {
            $json_response = array();
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($perfil));
            $competencias = $comando->fetchAll(PDO::FETCH_ASSOC);
            foreach ($competencias as $row) {
                $newrow = array();
                $newrow['id'] = $row['id'];
                $newrow['titulo'] = $row['titulo'];
                $newrow['descripcion'] = $row['descripcion'];
                $newrow['peso'] = $row['peso'];
                $newrow['detalles'] = detalleCompetenciaData::getAllFrom($row['id']);
                array_push($json_response, $newrow);
            }
            return $json_response;
            //return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    
    /*Obtener las competencias de un usuario de acuerdo a su perfil */
    public static function getCompetUser($idUser) {
        $consulta = "SELECT competencia.id, competencia.titulo, competencia.descripcion, competencia.peso
                                               FROM competencia, perfil_competencia, usuario, evaluacion_periodo
                                               WHERE usuario.id = ? AND
                                                              evaluacion_periodo.usuario = usuario.id AND
                                                              evaluacion_periodo.perfil_competencia = perfil_competencia.id AND
                                                              competencia.perfil = perfil_competencia.id;";
        try {
            $json_response = array();
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($idUser));
            $competencias = $comando->fetchAll(PDO::FETCH_ASSOC);
            foreach ($competencias as $row) {
                $newrow = array();
                $newrow['id'] = $row['id'];
                $newrow['titulo'] = $row['titulo'];
                $newrow['descripcion'] = $row['descripcion'];
                $newrow['peso'] = $row['peso'];
                $newrow['detalles'] = DetalleCompetencia::getAllFrom($row['id']);
                array_push($json_response, $newrow);
            }
            return $json_response;
        } catch (PDOException $e) {
            return false;
        }
    }
    
    
    

    public static function insert($titulo, $descripcion, $perfil) {
        $comando = "INSERT INTO competencia (titulo,descripcion,perfil) VALUES (?,?,?);";
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($titulo, $descripcion, $perfil));
            return true;
        } catch (PDOException $pdoExcetion) {
            return $pdoExcetion->getMessage();
        }
    }

    public static function update($titulo, $descripcion, $id) {
        $comando = "UPDATE competencia set titulo = ?, descripcion = ? where id = ? ;";
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($titulo, $descripcion, $id));
            return true;
        } catch (PDOException $pdoExcetion) {
            return $pdoExcetion->getMessage();
        }
    }

    public static function updatePeso($peso, $id) {
        $comando = "UPDATE  competencia set peso = ? where id = ? ;";
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($peso, $id));
            return true;
        } catch (PDOException $pdoExcetion) {
            return $pdoExcetion->getMessage();
        }
    }

    public static function delete($id) {
        $comando = "DELETE FROM competencia WHERE id = ?;";
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($id));
            return true;
        } catch (PDOException $pdoExcetion) {
            return $pdoExcetion->getMessage();
        }
    }

}

