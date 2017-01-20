<?php


/**
 * @author Isaac Corrales Cruz <isakucorrales@gmail.com>
 * @author Marco Vinicio Cambronero Fonseca <marcovcambronero@gmail.com>
 */



/**
 *  Esta es la clase encargada de la gestión de las empresas en la base de datos.
 */


class empresaData {

    function __construct() {
        
    }

    public static function getAll() {
        $consulta = "SELECT * FROM empresa";
        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute();
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function insert($nombre) {
        $comando = "INSERT INTO empresa (nombre) VALUES (?);";
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($nombre));
            return true;        
        } catch (PDOException $pdoExcetion) {
            return $pdoExcetion->getMessage();
        }
        return false;
    }

    public static function update($nombre, $id) {
        $comando = "UPDATE empresa set nombre = ? where id = ?;";
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($nombre, $id));
            return true;
        } catch (PDOException $pdoExcetion) {
            return $pdoExcetion->getMessage();
        }
        return false;
    }

    public static function delete($id) {
        $comando = "DELETE FROM empresa WHERE id = ?;";
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($id));
            return true;
        } catch (PDOException $pdoExcetion) {
            return $pdoExcetion->getMessage();
        }
        return false;
    }

}
