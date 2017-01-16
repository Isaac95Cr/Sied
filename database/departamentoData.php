<?php

require 'usuarioData.php';
require 'metasData.php';

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

    // Obtener todos los departamentos y sus respectivos usuarios (CON METAS APROBADAS POR JEFE)
    public static function departmentsUsersMetasAprob() {
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

                
                $usuariosDepartamento = usuarioData::getUsersByDepartament($row['id']);
                $newrow['usuarios'] = departamentoData::usersConMetasAprob($usuariosDepartamento);
                array_push($json_response, $newrow);
            }
            return $json_response;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    
    public static function departmentUsersMetasActual($departamento) {
        $consulta = "SELECT id, nombre, apellido1, apellido2 FROM usuario where departamento = ? AND usuario.estado = 1;";
        try {
            $json_response = array();
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($departamento));
            $users = $comando->fetchAll(PDO::FETCH_ASSOC);
            foreach ($users as $row) {
                $newrow = array();
                $newrow['id'] = $row['id'];
                $newrow['nombre'] = $row['nombre'];
                $newrow['apellido1'] = $row['apellido1'];
                $newrow['apellido2'] = $row['apellido2'];
                $newrow['metas'] = metasData::getAllFromUserActual($row['id']);
                array_push($json_response, $newrow);
            }
            return $json_response;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    
     public static function departmentUsersMetas($departamento,$periodo) {
        
        try {
            $json_response = array();
            $users = usuarioData::getAllWhenDep($periodo,$departamento);
            foreach ($users as $row) {
                $newrow = array();
                $newrow['id'] = $row['id'];
                $newrow['nombre'] = $row['nombre'];
                $newrow['apellido1'] = $row['apellido1'];
                $newrow['apellido2'] = $row['apellido2'];
                $newrow['metas'] = metasData::getAllFromUser($row['id'],$periodo);
                array_push($json_response, $newrow);
            }
            return $json_response;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    
    // Filtrar los usuarios con metas aprobadas por jefe y retornarlos en una lista
    public static function usersConMetasAprob($listaUsuarios) {

        $usuariosMetas = array();
        try {
            foreach ($listaUsuarios as $usuario) {
                $listaMetas = metasData::getAllFromUserActual($usuario['id']);
                if (departamentoData::tieneMetasAprobJefe($listaMetas)) {
                    array_push($usuariosMetas, $usuario);
                }
            }
            return $usuariosMetas;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    
    
    
    // Retorna true o false si dentro de la lista de metas recibidas existe alguna aprobada por jefe y no aprobada por RH.
    public static function tieneMetasAprobJefe($listaMetas) {
        foreach ($listaMetas as $meta) {
            if ($meta['aprobacion_j'] == 1 && $meta['aprobacion_rh'] == null) {
                return true;
            }
        }
        return false;
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
    
    
    
    
    
        // Obtener el departamento del cual es jefe un usuario específico
        // Luego se retornan los usuarios (que posean metas pendientes de aprobar/desaprobar) de dicho departamento.
//        public static function usersFromJefeMetasPendientes($idUser) {
//        $consulta = "SELECT departamento.id, departamento.nombre FROM departamento, usuario
//                                WHERE usuario.id = ? AND
//                                               usuario.id = departamento.jefe";
//        try {
//            $json_response = array();
//            $comando = Database::getInstance()->getDb()->prepare($consulta);
//            $comando->execute(array($idUser));
//            $departamentos = $comando->fetchAll(PDO::FETCH_ASSOC);
//            foreach ($departamentos as $row) {
//                $newrow = array();
//                $newrow['id'] = $row['id'];
//                $newrow['nombre'] = $row['nombre'];
//                
//                $usuariosDepartamento = usuarioData::getUsersByDepartament($row['id']);
//                $newrow['usuarios'] = departamentoData::usersMetasPendientesJefe($usuariosDepartamento);
//                array_push($json_response, $newrow);
//            }
//
//            return $json_response;
//        } catch (PDOException $e) {
//            return $e->getMessage();
//        }
//    }
    
    
    
    
    // Filtrar los usuarios con metas pendientes de aprobar por jefe y retornarlos en una lista
//    public static function usersMetasPendientesJefe($listaUsuarios) {
//
//        $usuariosMetas = array();
//        try {
//            foreach ($listaUsuarios as $usuario) {
//                $listaMetas = metasData::getAllFromUser($usuario['id']);
//                if (departamentoData::tieneMetasPendientesJefe($listaMetas)) {
//                    array_push($usuariosMetas, $usuario);
//                }
//            }
//            return $usuariosMetas;
//        } catch (PDOException $e) {
//            return $e->getMessage();
//        }
//    }
    
    
    
    
        // Retorna true o false si dentro de la lista de metas recibidas existe alguna pendiente de aprobar por jefe
//    public static function tieneMetasPendientesJefe($listaMetas) {
//        foreach ($listaMetas as $meta) {
//            if ($meta['aprobacion_j'] == null) {
//                return true;
//            }
//        }
//        return false;
//    }
    
    
    
    
    

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

}

;
