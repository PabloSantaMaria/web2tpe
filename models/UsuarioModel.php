<?php

require_once './models/BaseModel.php';

class UsuarioModel extends BaseModel {
    /**
    * trae los datos de un usuario existente
    */
    function fetchUser($user) {
        $sentencia = $this->db->prepare("SELECT * FROM usuario WHERE usuario=?");
        $sentencia->execute(array($user));
        $dbUser = $sentencia->fetch(PDO::FETCH_ASSOC);
        return $dbUser;
    }
    function isAdmin($user) {
        $sentencia = $this->db->prepare("SELECT * FROM usuario WHERE usuario=?");
        $sentencia->execute(array($user));
        $dbUser = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        if ($dbUser[0]['admin'] == 1) {
            return true;
        }
        else return false;
        // return $dbUser;
    }
    /**
    * inserta un usuario nuevo
    * la contraseña viene encriptada
    */
    function insertUsuario($user, $hash, $isAdmin) {
        $sentencia = $this->db->prepare("INSERT INTO usuario(usuario, pass, admin) VALUES(?,?,?)");
        $sentencia->execute(array($user, $hash, $isAdmin));
    }
    /**
    * borra un usuario existente
    */
    function deleteUser($user) {
        $sentencia = $this->db->prepare("DELETE FROM usuario WHERE usuario=?");
        $sentencia->execute(array($user));
    }
    /**
    * devuelve boolean según la existencia de un dato en una tabla
    */
    function existeItem($tabla, $item) {
        $sentencia = $this->db->prepare("SELECT $tabla.$tabla FROM $tabla");
        $sentencia->execute(array());
        $valores = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        $contiene = false;
        foreach ($valores as $valor) {
            if ($valor[$tabla] == $item) {
                $contiene = true;
            }
        }
        return $contiene;
    }
    /**
    * devuelve la id de un dato en una tabla
    */
    function getID($tabla, $item) {
        $campoID = "id_" . $tabla;
        $sentencia = $this->db->prepare("SELECT $tabla.$campoID FROM $tabla WHERE $tabla.$tabla = '$item'");
        $sentencia->execute(array());
        $id_item = $sentencia->fetch(PDO::FETCH_ASSOC);
        return $id_item[$campoID];
    }
}