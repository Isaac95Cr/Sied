<?php

require 'database.php';

class departamentoData {

    public static function getAll() {
        $consulta = "SELECT * FROM departamento;";
        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute();
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function insert($nombre, $empresa) {
        $comando = "INSERT INTO departamento (nombre, empresa) VALUES (?,?);";
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($nombre, $empresa));
            return true;
        } catch (PDOException $pdoExcetion) {
            return $pdoExcetion->getMessage();
        }
    }

    public static function update($nombre, $id) {
        $comando = "UPDATE departamento set nombre = ? where id = ?;";
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($nombre, $id));
            return true;
        } catch (PDOException $pdoExcetion) {
            return$pdoExcetion->getMessage();
        }
    }

    public static function delete($id) {
        $comando = "DELETE FROM departamento WHERE id = ?;";
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($id));
            return true;
        } catch (PDOException $pdoExcetion) {
            return $pdoExcetion->getMessage();
        }
    }

};
