<?php

/**
 * @author Isaac Corrales Cruz <isakucorrales@gmail.com>
 * @author Marco Vinicio Cambronero Fonseca <marcovcambronero@gmail.com>
 */

/**
  Clase encargada de la gestión de metas en la base de datos.
 */
class metasData {

    function __construct() {
        
    }

    public static function getAll() {
        $consulta = "SELECT * FROM meta";
        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute();
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function insert($is_Evaluable, $peso, $titulo, $descripcion, $usuario) {
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
            return true;
        } catch (PDOException $pdoExcetion) {
            return $pdoExcetion->getMessage();
        }
    }

    public static function getAllFrom($id) {
        $consulta = "SELECT * FROM meta where id = ?;";
        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($id));
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function getAllFromUserActual($id) {
        $consulta = "SELECT * FROM sied.meta inner join 
(SELECT id as actual FROM periodo WHERE NOW() BETWEEN periodo.fechainicio AND periodo.fechafinal) 
as actual on meta.periodo = actual where meta.usuario = ?;";
        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($id));
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
    
    public static function getAllFromUser($id,$periodo) {
        $consulta = "SELECT * FROM sied.meta where meta.usuario = ? and meta.periodo = ? ;";
        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($id,$periodo));
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function delete($id) {
        $comando = "DELETE FROM meta WHERE id = ?;";
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($id));
            return true;
        } catch (PDOException $pdoExcetion) {
            return $pdoExcetion->getMessage();
        }
    }

    // Actualiza toda la meta.
    public static function update($is_Evaluable, $titulo, $descripcion, $id) {

        $comando = "UPDATE meta SET evaluable = b?, titulo = ?, descripcion = ?, aprobacion_j = ?, aprobacion_rh = ?, comentario_j = ?, comentario_rh = ?  WHERE id = ?";

        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($is_Evaluable, $titulo, $descripcion, NULL, NULL, NULL, NULL, $id));

            return true;
        } catch (PDOException $pdoExcetion) {
            return $pdoExcetion->getMessage();
        }
    }

    // Actualiza si la meta es evaluable o no.
    public static function updateEvaluableMeta($is_Evaluable, $id) {

        $comando = "UPDATE meta SET evaluable = b? WHERE id = ?";

        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($is_Evaluable, $id));

            return true;
        } catch (PDOException $pdoExcetion) {
            return $pdoExcetion->getMessage();
        }
    }

    public static function updateAuto($arreglo) {

        try {
            for ($i = 0; $i < count($arreglo); $i++) {
                $comando = "UPDATE meta set auto_evaluacion = ? where id = ?";
                $sentencia = Database::getInstance()->getDb()->prepare($comando);
                $valor_Array = $arreglo[$i]['valor'];
                $id_Array = $arreglo[$i]['id'];
                $sentencia->execute(array($valor_Array, $id_Array));
            }
            return true;
        } catch (PDOException $pdoExcetion) {
            return $pdoExcetion->getMessage();
        }
    }

    public static function updateEvaluacion($arreglo) {

        try {
            for ($i = 0; $i < count($arreglo); $i++) {
                $comando = "UPDATE meta set evaluacion = ? where id = ?";
                $sentencia = Database::getInstance()->getDb()->prepare($comando);
                $valor_Array = $arreglo[$i]['valor'];
                $id_Array = $arreglo[$i]['id'];
                $sentencia->execute(array($valor_Array, $id_Array));
            }
            return true;
        } catch (PDOException $pdoExcetion) {
            return $pdoExcetion->getMessage();
        }
    }

    // Desaprobar meta de parte de Jefe.
    public static function desaprobarMeta($id, $comment) {

        $comando = "UPDATE meta SET aprobacion_j = b?, comentario_j = ?  WHERE id = ?;";

        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array(0, $comment, $id));

            return true;
        } catch (PDOException $pdoExcetion) {
            return $pdoExcetion->getMessage();
        }
    }

// Aprobar meta de parte de Jefe. 
    public static function aprobarMeta($id, $comment) {
        $comando = "UPDATE meta SET aprobacion_j = b?, comentario_j = ?  WHERE id = ?;";

        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array(1, $comment, $id));

            return true;
        } catch (PDOException $pdoExcetion) {
            return $pdoExcetion->getMessage();
        }
    }

    // Desaprobar meta de parte de RH.
    public static function desaprobarMetaRH($id, $comment) {

        $comando = "UPDATE meta SET aprobacion_rh = b?, comentario_rh = ?  WHERE id = ?;";

        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array(0, $comment, $id));

            return true;
        } catch (PDOException $pdoExcetion) {
            return $pdoExcetion->getMessage();
        }
    }

// Aprobar meta de parte de RH. 
    public static function aprobarMetaRH($id, $comment) {
        $comando = "UPDATE meta SET aprobacion_rh = b?, comentario_rh = ?  WHERE id = ?;";

        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array(1, $comment, $id));

            return true;
        } catch (PDOException $pdoExcetion) {
            return $pdoExcetion->getMessage();
        }
    }

    public static function updatePeso($arreglo) {

        try {
            for ($i = 0; $i < count($arreglo); $i++) {
                $comando = "UPDATE meta set peso = ? WHERE id = ?";
                $sentencia = Database::getInstance()->getDb()->prepare($comando);
                $peso_Array = $arreglo[$i]['peso'];
                $id_Array = $arreglo[$i]['id'];
                $sentencia->execute(array($peso_Array, $id_Array));
            }

            return true;
        } catch (PDOException $pdoExcetion) {
            return $pdoExcetion->getMessage();
        }
    }

}
