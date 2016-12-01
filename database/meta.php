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
    
    
    
    public static function insert_Meta($is_Evaluable, $peso, $titulo, $descripcion, $usuario) {        
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
                                                            1, $usuario));         
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
    
    
      public static function getMetas_User($id) {
            $consulta = "SELECT * FROM meta WHERE usuario = ?;";
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
    
    
    public static function update_Meta($is_Evaluable, $titulo, $descripcion, $id) {        
        
        $comando =   "UPDATE meta set evaluable = b?, titulo = ?, descripcion = ? WHERE id = ?";
                
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($is_Evaluable, $titulo, $descripcion, $id));
            
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
                $valor_Array = $arreglo[$i]['valor'];
                $id_Array = $arreglo[$i]['id'];
                $sentencia->execute(array($valor_Array, $id_Array));
            }
            return new Mensaje("Éxito", "<p>Se ingresaron las autoevaluaciones</p>");
        }
            catch (PDOException $pdoExcetion) {
                return new Mensaje("Error", "<p>Error:" . $pdoExcetion->getMessage(). "</p>");
            }
 }
 
 
 
 
public static function update_Evaluacion($arreglo) {        
               
        try{
          for($i = 0; $i < count($arreglo); $i++){
                $comando = "UPDATE meta set evaluacion = ? where id = ?";
                $sentencia = Database::getInstance()->getDb()->prepare($comando);
                $valor_Array = $arreglo[$i]['valor'];
                $id_Array = $arreglo[$i]['id'];
                $sentencia->execute(array($valor_Array, $id_Array));
            }
            return new Mensaje("Éxito", "<p>Se ingresaron las evaluaciones</p>");
        }
            catch (PDOException $pdoExcetion) {
                return new Mensaje("Error", "<p>Error:" . $pdoExcetion->getMessage(). "</p>");
            }
 }
        
        
 
 public static function desaprobarMeta($id, $comment) {       
     
        $comando =   "UPDATE meta SET aprobacion_j = b?, comentario_j = ?  WHERE id = ?;";
                
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array(0, $comment, $id));
            
            return new Mensaje("Éxito", "<p>Meta desaprobada con éxito</p>");
        } catch (PDOException $pdoExcetion) {
            return new Mensaje("Error", "<p>Error:" . $pdoExcetion->getMessage(). "</p>");
        }
 }
 
 
  public static function aprobarMeta($id, $comment) {        
        $comando =   "UPDATE meta SET aprobacion_j = b?, comentario_j = ?  WHERE id = ?;";
                
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array(1, $comment, $id));
            
            return new Mensaje("Éxito", "<p>Meta aprobada con éxito</p>");
            
        } catch (PDOException $pdoExcetion) {
            return new Mensaje("Error", "<p>Error:" . $pdoExcetion->getMessage(). "</p>");
        }
 }
 
 
 
     public static function update_PesoMeta($arreglo) {      
         
      try {        
        for($i = 0; $i < count($arreglo); $i++){
                $comando =   "UPDATE meta set peso = ? WHERE id = ?";
                $sentencia = Database::getInstance()->getDb()->prepare($comando);
                $peso_Array = $arreglo[$i]['peso'];
                $id_Array = $arreglo[$i]['id'];
                $sentencia->execute(array($peso_Array, $id_Array));
         }
                
           return new Mensaje("Éxito", "<p>Pesos actualizados con éxito</p>");
        } catch (PDOException $pdoExcetion) {
            return new Mensaje("Error", "<p>Error:" . $pdoExcetion->getMessage(). "</p>");
        }
    }
        
        
        
    }


