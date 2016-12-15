<?php

require 'database.php';

class evaluacionCompetenciaData {

    public static function insert_Evaluacion($evaluacion) {
        try {

            $userColab = $evaluacion['idColab'];
            $is_RegistrosColab = evaluacionCompetenciaData::getAutoFromUser($userColab);  // comprobar si existen registros del user.

            if (isset($is_RegistrosColab[0])) {   // si existen, entonces actualice...
                
                $existeId = $is_RegistrosColab[0]['id'];  // se extrae el id del registro si lo hay, sino es null
                $comando = "UPDATE evaluacion_competencia 
		            SET auto_evaluacion = ?
	                                  WHERE evaluacion_competencia.id = ? ;";

                $sentencia = Database::getInstance()->getDb()->prepare($comando);
                $valores_Autoev = $evaluacion['value'];
                $sentencia->execute(array($valores_Autoev, $existeId));
                
            } else { // si no existen, entonces inserte uno nuevo.
                $comando = "INSERT INTO evaluacion_competencia (auto_evaluacion, "
                        . "evaluacion, "
                        . "evaluacion_periodo) VALUES (?,?,?);";

                $sentencia = Database::getInstance()->getDb()->prepare($comando);
                $valores_Autoev = $evaluacion['value'];
                $sentencia->execute(array($valores_Autoev, NULL, 1));
            }

           return true;
        } catch (PDOException $pdoExcetion) {
            return  $pdoExcetion->getMessage();
        }
    }   
    
    /* Obtener las autoevaluaciones, evaluaciones y el id de los detalles de competencias de un usuario */

    public static function getAutoFromUser($idUser) {
        $consulta = "SELECT evaluacion_competencia.id, evaluacion_competencia.auto_evaluacion,
                                               evaluacion_competencia.evaluacion
                                               FROM evaluacion_competencia, usuario, evaluacion_periodo
		   WHERE usuario.id = ? AND
                                                              usuario.id = evaluacion_periodo.usuario AND
                                                              evaluacion_periodo.id = evaluacion_competencia.evaluacion_periodo;";
        try {
            $json_response = array();
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($idUser));
            $competencias = $comando->fetchAll(PDO::FETCH_ASSOC);
            foreach ($competencias as $row) {
                $newrow = array();
                $newrow['id'] = $row['id'];
                $newrow['auto_evaluacion'] = $row['auto_evaluacion'];
                $newrow['evaluacion'] = $row['evaluacion'];
                array_push($json_response, $newrow);
            }
            return $json_response;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function updateEvaluacionesDetalles($evaluaciones, $id, $idColab) {

        try {
            $is_RegistrosColab = evaluacion_Competencia::getAutoEvCompetUser($idColab);  // comprobar si existen registros del user.

            if (isset($is_RegistrosColab[0]) ) {   // si existen, entonces actualice...
                
                $comando = "UPDATE  evaluacion_competencia set evaluacion = ? where id = ? ;";
                $sentencia = Database::getInstance()->getDb()->prepare($comando);
                $sentencia->execute(array($evaluaciones, $id));
                
            }else{  // sino entonces inserte...
                
               $comando = "INSERT INTO evaluacion_competencia (auto_evaluacion, "
                                       . "evaluacion, "
                                       . "evaluacion_periodo) VALUES (?,?,?);";

                $sentencia = Database::getInstance()->getDb()->prepare($comando);
                $sentencia->execute(array(NULL, $evaluaciones, 1));
            }

            return true;
        } catch (PDOException $pdoExcetion) {
            return $pdoExcetion->getMessage();
        }
    }

}
