<?php

require 'database.php';

class Departamento{
    
    
    public static function getAll(){
        $consulta = "SELECT * FROM departamento;";
        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute();
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }   
    }
    
     public static function insert($nombre, $empresa){
        $comando = "INSERT INTO departamento (nombre, empresa) VALUES (?,?);";
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute(array($nombre,$empresa));
    }
    
    public static function delete($id){
        $comando = "DELETE FROM departamento WHERE id = ?;";
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute(array($id));
    }
};