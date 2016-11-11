<?php

require 'database.php';
require 'mensaje.php';

class evaluacion_Competencia {

    public static function insert_Evaluacion($evaluacion) {
        try {
            $comando = "INSERT INTO evaluacion_competencia (auto_evaluacion, "
                    . "evaluacion, "
                    . "evaluacion_periodo) VALUES (?,?,?);";
            $sentencia = Database::getInstance()->getDb()->prepare($comando);
            $valores_Autoev = $evaluacion[value];
            $sentencia->execute(array($valores_Autoev, NULL, 1));

            return new Mensaje("Éxito", "<p>Se ingresaron las autoevaluaciones</p>");
        } catch (PDOException $pdoExcetion) {
            return new Mensaje("Error", "<p>Error:" . $pdoExcetion->getMessage() . "</p>");
        }
    }

    
    
    /* Obtener las autoevaluaciones de los detalles de competencias de un usuario */
    public static function getAutoEvCompetUser($idUser) {
        $consulta = "SELECT evaluacion_competencia.auto_evaluacion 
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
                $newrow['auto_evaluacion'] = $row['auto_evaluacion'];
                array_push($json_response, $newrow);
            }
            return $json_response;
            //return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

}
