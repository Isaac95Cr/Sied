<?php


class departamentoData {

    public static function getAll() {
        $consulta = "SELECT * FROM departamento;";
        try {
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute();
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
    
    
    // Obtener todos los departamentos y sus respectivos usuarios.
        public static function getDepartmentsAndUsers() {
        $consulta = "SELECT * FROM departamento;";
        try {
            $json_response = array();
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute();
            $departamentos = $comando->fetchAll(PDO::FETCH_ASSOC);
            foreach ($departamentos as $row) {
                $newrow = array();
                $newrow['id'] = $row['id'];
                $newrow['nombre'] = $row['nombre'];
                $newrow['usuarios'] = usuarioData::getUsersByDepartament($row['id']);
                array_push($json_response, $newrow);
            }
            return $json_response;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    
    
    
       // Obtener el departamento del cual es jefe un usuario específico
       // Luego se retornan los usuarios de dicho departamento.
        public static function getUsersFromJefe($idUser) {
        $consulta = "SELECT departamento.id, departamento.nombre FROM departamento, usuario
                                WHERE usuario.id = ? AND
                                               usuario.id = departamento.jefe";
        try {
            $json_response = array();
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($idUser));
            $departamentos = $comando->fetchAll(PDO::FETCH_ASSOC);
            foreach ($departamentos as $row) {
                $newrow = array();
                $newrow['id'] = $row['id'];
                $newrow['nombre'] = $row['nombre'];
                $newrow['usuarios'] = usuarioData::getUsersByDepartament($row['id']);
                array_push($json_response, $newrow);
            }

            return $json_response;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    } 
    
    

    
    public static function insert($nombre, $empresa) {
        $comando = "INSERT INTO departamento (nombre, empresa) VALUES (?,?);";
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($nombre, $empresa));
            return true;
        } catch (PDOException $pdoExcetion) {
            return $pdoExcetion->getMessage();
        }
    }

    public static function update($nombre, $id) {
        $comando = "UPDATE departamento set nombre = ? where id = ?;";
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($nombre, $id));
            return true;
        } catch (PDOException $pdoExcetion) {
            return$pdoExcetion->getMessage();
        }
    }

    public static function delete($id) {
        $comando = "DELETE FROM departamento WHERE id = ?;";
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        try {
            $sentencia->execute(array($id));
            return true;
        } catch (PDOException $pdoExcetion) {
            return $pdoExcetion->getMessage();
        }
    }

};
