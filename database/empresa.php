<?php

require 'database.php';

class Empresa {

    function __construct() {
        
    }
    public static function getAll(){
        $consulta = "SELECT * FROM empresa";
        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute();
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }   
    }
    
    public static function insert($nombre){
        $comando = "INSERT INTO empresa (nombre) VALUES (?);";
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute(array($nombre));
    }
    
    public static function delete($id){
        $comando = "DELETE FROM empresa WHERE id = ?;";
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute(array($id));
    }
    
}
