<?php

require 'periodoData.php';

class evaluacionPeriodoData{
    
     function __construct() {
        
    }
    
// OBTENER EL ID DE LA EVALUACIÓN PERIODO QUE COINCIDA CON EL PERIODO ACTUAL Y 
// CON UN USUARIO ESPECÍFICO.
    public static function getEvaluacionPeriodoUser($idUser) {
        $idPeriodoActual = periodoData::getActual()['id'];
        $consulta = "SELECT evaluacion_periodo.id FROM evaluacion_periodo, usuario
                               WHERE usuario.id = ? AND
		  usuario.id = evaluacion_periodo.usuario AND
                                              evaluacion_periodo.periodo = ? ;";
        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($idUser, $idPeriodoActual));
            $result = $comando->fetch(PDO::FETCH_ASSOC);
            return $result['id'];
        } catch (PDOException $e) {
            return false;
        }
    }
    
    
    
    
    
}

