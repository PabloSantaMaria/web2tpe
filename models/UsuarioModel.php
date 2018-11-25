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
    function fetUserById($id_usuario) {
        $sentencia = $this->db->prepare("SELECT FROM usuario WHERE id_usuario=?");
        $sentencia->execute(array($id_usuario));
        $dbUser = $sentencia->fetch(PDO::FETCH_ASSOC);
        return $dbUser;
    }
    function getUsuarios() {
        $sentencia = $this->db->prepare("SELECT usuario.id_usuario, usuario.usuario, usuario.admin FROM usuario");
        $sentencia->execute(array());
        $usuarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $usuarios;
    }

    function isAdmin($user) {
        $sentencia = $this->db->prepare("SELECT * FROM usuario WHERE usuario=?");
        $sentencia->execute(array($user));
        $dbUser = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        if ($dbUser[0]['admin'] == 1) {
            return true;
        }
        else return false;
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

    function deleteUserById($id_usuario) {
        $sentencia = $this->db->prepare("DELETE FROM usuario WHERE id_usuario=?");
        $sentencia->execute(array($id_usuario));
    }

    function editarPermisos($id_usuario, $isAdmin) {
        $sentencia = $this->db->prepare("UPDATE usuario SET usuario.admin = ? WHERE usuario.id_usuario = ?");
        $sentencia->execute(array($isAdmin, $id_usuario));
        return $this->fetUserById($id_usuario);
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
    function getID($usuario) {
        $sentencia = $this->db->prepare("SELECT usuario.id_usuario FROM usuario WHERE usuario.usuario = ?");
        $sentencia->execute(array($usuario));
        $id_usuario = $sentencia->fetch(PDO::FETCH_ASSOC);
        return $id_usuario['id_usuario'];
    }
}