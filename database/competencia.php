<?php
require 'detalleCompetencia.php';

class Competencia {

    public static function getAll() {
        $consulta = "SELECT * FROM competencia;";
        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute();
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
    public static function getAllFrom($perfil) {
        $consulta = "SELECT * FROM competencia where perfil = ?;";
        try {
            $json_response = array();
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($perfil));
            $competencias = $comando->fetchAll(PDO::FETCH_ASSOC);
            foreach ($competencias as $row){
                $newrow = array();
                $newrow['id'] = $row['id'];
                $newrow['titulo'] = $row['titulo'];
                $newrow['descripcion'] = $row['descripcion'];
                $newrow['peso'] = $row['peso'];
                $newrow['detalles'] = DetalleCompetencia::getAllFrom($row['id']);
                array_push($json_response, $newrow);
            }
            return $json_response;
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function insert($titulo,$descripcion,$peso,$perfil) {
        $comando = "INSERT INTO competencia (titulo,descripcion,peso,perfil) VALUES (?,?,?,?);";
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($titulo,$descripcion,$peso,$perfil));
            return new Mensaje("Exito", "<p>Se agregó la competencia con exito :D</p>");
        } catch (PDOException $pdoExcetion) {
            return new Mensaje("Error", "<p>Error#" . $pdoExcetion->getCode() . "</p>");
        }
    }

    public static function delete($id) {
        $comando = "DELETE FROM competencia WHERE id = ?;";
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($id));
            return new Mensaje("Exito", "<p>Se eliminó la competencia con exito :D</p>");
        } catch (PDOException $pdoExcetion) {
            return new Mensaje("Error", "<p>Error#" . $pdoExcetion->getCode() . "</p>");
        }
    }

}




