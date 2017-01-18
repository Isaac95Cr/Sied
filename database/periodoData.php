<?php

class periodoData {

    public static function getAll() {
        $consulta = "SELECT *  FROM periodo;";
        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute();
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function getActual() {
        $consulta = "SELECT * FROM periodo WHERE NOW() BETWEEN periodo.fechainicio AND periodo.fechafinal;";
        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute();
            return $comando->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e;
        }
    }
    
    public static function getAnterior() {
        $consulta = "select (periodo.id) as periodo, actual.id as actual from periodo,(SELECT id FROM periodo WHERE NOW() BETWEEN periodo.fechainicio AND periodo.fechafinal)as actual 
where actual.id > periodo.id order by periodo.id desc limit 1";
        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute();
            return $comando->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e;
        }
    }

    public static function insert($id, $fechainicio, $fechafinal, $nombre, $fiper1, $ffper1, $fiper2, $ffper2) {
        $comando = "INSERT INTO periodo (id, fechainicio, fechafinal, nombre, fiper1, ffper1, fiper2, ffper2)"
                . " VALUES (?, ?,?, ?, ?, ?, ?, ?);";
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($id, $fechainicio, $fechafinal, $nombre, $fiper1, $ffper1, $fiper2, $ffper2));
            return true;
        } catch (PDOException $pdoExcetion) {
            return $pdoExcetion->getMessage();
        }
    }

    public static function update($id, $fechainicio, $fechafinal, $nombre, $fiper1, $ffper1, $fiper2, $ffper2) {
        $comando = "UPDATE periodo SET fechainicio=?, fechafinal=?, nombre=?, fiper1=?, ffper1=?, fiper2=?, ffper2=? WHERE id=?;
";
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($fechainicio, $fechafinal, $nombre, $fiper1, $ffper1, $fiper2, $ffper2, $id));
            return true;
        } catch (PDOException $pdoExcetion) {
            return$pdoExcetion->getMessage();
        }
    }

    public static function delete($id) {
        $comando = "DELETE FROM periodo WHERE id = ?;";
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($id));
            return true;
        } catch (PDOException $pdoExcetion) {
            return $pdoExcetion->getMessage();
        }
    }

}

;

