<?php

require_once './models/BaseModel.php';

class ComentarioModel extends BaseModel {
    
    function getComentario($id_comentario) {
        $sentencia = $this->db->prepare("SELECT comentario.*, usuario.usuario FROM comentario, usuario WHERE comentario.id_comentario = ? AND comentario.id_usuario = usuario.id_usuario");
        $sentencia->execute(array($id_comentario));
        $comentario = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $comentario;
    }
    
    function getComentarios($id_accion) {
        $sentencia = $this->db->prepare("SELECT comentario.*, accion.accion, usuario.usuario FROM comentario, accion, usuario WHERE accion.id_accion = ? AND accion.id_accion = comentario.id_accion ORDER BY comentario.date ASC");
        $sentencia->execute(array($id_accion));
        $comentarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $comentarios;
    }
    
    function postComentario($titulo, $cuerpo, $id_accion, $id_usuario) {
        $sentencia = $this->db->prepare("INSERT INTO comentario(titulo, cuerpo, id_accion, id_usuario) VALUES(?,?,?,?)");
        $sentencia->execute(array($titulo, $cuerpo, $id_accion, $id_usuario));
        $lastInsertId = $this->db->lastInsertId();
        $comentarioNuevo = $this->getComentario($lastInsertId);
        return $comentarioNuevo[0];
    }
    
    function deleteComentario($id_comentario) {
        $comentario = $this->getComentario($id_comentario);
        if (isset($comentario)) {
            $sentencia = $this->db->prepare("DELETE FROM comentario WHERE id_comentario = ?");
            $sentencia->execute(array($id_comentario));
            return $comentario[0];
        }
    }
}