<?php
require 'database.php';
require 'mensaje.php';

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
    public static function getFrom($perfil) {
        $consulta = "SELECT * FROM competencia where perfil = ?;";
        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($perfil));
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




