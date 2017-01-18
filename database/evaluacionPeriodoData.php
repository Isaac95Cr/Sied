<?php

require 'periodoData.php';

class evaluacionPeriodoData {

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

    // Obtiene la aprobacion_j y aprobacion_rh de la evaluacion periodo de un usuario.
    public static function getEvaluacionJefeRHActual($idUser) {
        $consulta = "SELECT evaluacion_periodo.id, evaluacion_periodo.aprobacion_j, evaluacion_periodo.aprobacion_rh
                                 FROM sied.evaluacion_periodo inner join
                                (SELECT id as actual FROM periodo WHERE NOW() BETWEEN periodo.fechainicio AND periodo.fechafinal)
                                as actual on evaluacion_periodo.periodo = actual
                                where usuario = ? ;";
        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($idUser));
            $result = $comando->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            return false;
        }
    }

}