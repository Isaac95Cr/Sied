<?php

 /**
  * @author Isaac Corrales Cruz <isakucorrales@gmail.com>
  * @author Marco Vinicio Cambronero Fonseca <marcovcambronero@gmail.com>
  */

require 'database.php';
require 'mensaje.php';


 /**
    Clase encargada de la gestión de metas en la base de datos.
  */

class Meta{

    
    function __construct() {
        
    }

    public static function getAll_Metas() {
        $consulta = "SELECT * FROM meta";
        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute();
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
    
    
    
    public static function insert_Meta($is_Evaluable, $peso, $titulo, $descripcion) {        
        $comando = "INSERT INTO meta (evaluable, "
                                                                . "peso, "
                                                                . "titulo, "
                                                                . "descripcion, "
                                                                . "auto_evaluacion, "
                                                                . "evaluacion,"
                                                                . "aprobacion_j,"
                                                                . "aprobacion_rh,"
                                                                . "comentario_j,"
                                                                . "comentario_rh,"
                                                                . "periodo,"
                                                                . "usuario) VALUES (b?,?,?,?,?,?,?,?,?,?,?,?);";
        
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($is_Evaluable, $peso, $titulo, 
                                                           $descripcion, NULL, NULL,
                                                            NULL, NULL, NULL, NULL,
                                                            1, 402270956));         
            return new Mensaje("Éxito", "<p>Se agregó la meta con éxito</p>");
        } catch (PDOException $pdoExcetion) {
            return new Mensaje("Error", "<p>Error:" . $pdoExcetion->getMessage(). "</p>");
        }
    }
    
    
    
    
      public static function getAllFrom($id) {
        $consulta = "SELECT * FROM meta where id = ?;";
            try {
                $comando = Database::getInstance()->getDb()->prepare($consulta);
                $comando->execute(array($id));
                return $comando->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return false;
            }
    }
    
   
   public static function delete_Meta($id) {
        $comando = "DELETE FROM meta WHERE id = ?;";
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($id));
            return new Mensaje("Exito", "<p>Se eliminó la meta con éxito</p>");
        } catch (PDOException $pdoExcetion) {
            return new Mensaje("Error", "<p>Error#" . $pdoExcetion->getCode() . "</p>");
        }
    }
    
    
    public static function update_Meta($is_Evaluable, $peso, $titulo, $descripcion, $id) {        
        
        $comando =   "UPDATE meta set evaluable = b?, peso = ?, titulo = ?, descripcion = ? WHERE id = ?";
                
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($is_Evaluable, $peso, $titulo, $descripcion, $id));
            
            return new Mensaje("Éxito", "<p>Se actualizó la meta con éxito</p>");
        } catch (PDOException $pdoExcetion) {
            return new Mensaje("Error", "<p>Error:" . $pdoExcetion->getMessage(). "</p>");
        }
    }
    
    
    
    public static function update_AutoEvaluaciones($arreglo) {        
               
        try{
          for($i = 0; $i < count($arreglo); $i++){
                $comando = "UPDATE meta set auto_evaluacion = ? where id = ?";
                $sentencia = Database::getInstance()->getDb()->prepare($comando);
                $valor_Array = $arreglo[$i][valor];
                $id_Array = $arreglo[$i][id];
                $sentencia->execute(array($valor_Array, $id_Array));
            }
            return new Mensaje("Éxito", "<p>Se ingresaron las autoevaluaciones</p>");
        }
            catch (PDOException $pdoExcetion) {
                return new Mensaje("Error", "<p>Error:" . $pdoExcetion->getMessage(). "</p>");
            }
 }
        
        
        
        
        
    }


