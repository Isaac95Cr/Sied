<?php

require 'database.php';
require 'mensaje.php';

class DetalleCompetencia {

    public static function getAll() {
        $consulta = "SELECT * FROM detalle_competencia;";
        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute();
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function getAllFrom($competencia) {
        $consulta = "SELECT * FROM detalle_competencia where competencia = ?;";
        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($competencia));
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function insert($descripcion, $competencia) {
        $comando = "INSERT INTO detalle_competencia (descripcion, competencia) VALUES (?,?);";
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($descripcion, $competencia));
            return new Mensaje("Exito", "<p>Se agregó el detalle con exito :D</p>");
        } catch (PDOException $pdoExcetion) {
            return new Mensaje("Error", "<p>Error#" . $pdoExcetion->getCode() . "</p>");
        }
    }

    public static function update($descripcion, $id) {
        $comando = "UPDATE detalle_competencia SET descripcion = ? WHERE id = ?";
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($descripcion,$id));
            return new Mensaje("Exito", "<p>Se modificó el detalle con exito :D</p>");
        } catch (PDOException $pdoExcetion) {
            return new Mensaje("Error", "<p>Error#" . $pdoExcetion->getCode() . "</p>");
        }
    }

    public static function delete($id) {
        $comando = "DELETE FROM detalle_competencia WHERE id = ?;";
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($id));
            return new Mensaje("Exito", "<p>Se eliminó el detalle con exito :D</p>");
        } catch (PDOException $pdoExcetion) {
            return new Mensaje("Error", "<p>Error#" . $pdoExcetion->getCode() . "</p>");
        }
    }

}
