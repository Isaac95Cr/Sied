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

}
