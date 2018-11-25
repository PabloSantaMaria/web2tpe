<?php
require_once './models/BaseModel.php';

class ComentarioModel extends BaseModel {
    /**
     * trae un comentario por id
     */
    function getComentario($id_comentario) {
        $sentencia = $this->db->prepare("SELECT comentario.* FROM comentario WHERE comentario.id_comentario = ?");
        $sentencia->execute(array($id_comentario));
        $comentario = $sentencia->fetch(PDO::FETCH_ASSOC);
        return $comentario;
    }
    /**
     * trae los comentarios de una acción, ordenados por puntaje
     */
    function getComentarios($id_accion, $ratingOrder) {
        if ($ratingOrder == 'ASC') {
            $sentencia = $this->db->prepare("SELECT comentario.*, accion.accion, usuario.usuario FROM comentario, accion, usuario WHERE accion.id_accion = ? AND accion.id_accion = comentario.id_accion AND comentario.id_usuario = usuario.id_usuario ORDER BY comentario.puntaje ASC");
        }
        elseif ($ratingOrder == 'DESC') {
            $sentencia = $this->db->prepare("SELECT comentario.*, accion.accion, usuario.usuario FROM comentario, accion, usuario WHERE accion.id_accion = ? AND accion.id_accion = comentario.id_accion AND comentario.id_usuario = usuario.id_usuario ORDER BY comentario.puntaje DESC");
        }
        else {
            $sentencia = $this->db->prepare("SELECT comentario.*, accion.accion, usuario.usuario FROM comentario, accion, usuario WHERE accion.id_accion = ? AND accion.id_accion = comentario.id_accion AND comentario.id_usuario = usuario.id_usuario ORDER BY comentario.date ASC");
        }
        
        $sentencia->execute(array($id_accion));
        $comentarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $comentarios;
    }
    /**
     * inserta comentario
     */
    function postComentario($titulo, $cuerpo, $puntaje, $id_accion, $id_usuario) {
        $sentencia = $this->db->prepare("INSERT INTO comentario(titulo, cuerpo, puntaje, id_accion, id_usuario) VALUES(?,?,?,?,?)");
        $sentencia->execute(array($titulo, $cuerpo, $puntaje, $id_accion, $id_usuario));
        $lastInsertId = $this->db->lastInsertId();
        $comentarioNuevo = $this->getComentario($lastInsertId);
        return $comentarioNuevo;
    }
    /**
     * borra comentario por id
     */
    function deleteComentario($id_comentario) {
        $comentario = $this->getComentario($id_comentario);
        if (isset($comentario)) {
            $sentencia = $this->db->prepare("DELETE FROM comentario WHERE id_comentario = ?");
            $sentencia->execute(array($id_comentario));
            return $comentario;
        }
    }
}