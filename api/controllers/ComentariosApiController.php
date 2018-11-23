<?php
require_once "api/Api.php";
require_once 'models/ComentarioModel.php';
require_once 'models/UsuarioModel.php';

class ComentariosApiController extends Api {
    private $comentariosModel;
    private $usuariosModel;
    
    function __construct(){
        parent::__construct();
        $this->comentariosModel = new ComentarioModel();
        $this->usuariosModel = new UsuarioModel();
    }
    
    function comentariosAccion($params) {
        $id_accion = $params[0];
        $ratingOrder = $params[1];
        $data = $this->comentariosModel->getComentarios($id_accion, $ratingOrder);
        if ($data != null) {
            return $this->json_response($data, 200);
        }
        else {
            return $this->json_response("No existen comentarios", 404);
        }
    }
    
    function postComentario($param) {
        session_start();
        if (isset($param) && isset($_SESSION['user'])) {
            $id_accion = $param[0];
            $body = $this->getData();
            $usuario = $body->usuario;
            $id_usuario = $this->usuariosModel->getID('usuario', $usuario);
            $titulo = $body->titulo;
            $cuerpo = $body->cuerpo;
            $puntaje = $body->puntaje;
            
            $comentarioNuevo = $this->comentariosModel->postComentario($titulo, $cuerpo, $puntaje, $id_accion, $id_usuario);
            if (!$comentarioNuevo) {
                return $this->json_response("comentario vacío", 300);
            }
            else {
                return $this->json_response($comentarioNuevo, 200);
            }
        }
        else {
            return $this->json_response("Server Error", 500);
        }
    }
    
    function deleteComentario($param) {
        session_start();
        if (isset($_SESSION['user'])) {
            $isAdmin = $this->usuariosModel->isAdmin($_SESSION['user']);
        }
        else {
            $isAdmin = false;
        }
        if (isset($param) && $isAdmin) {
            $id_comentario = $param[0];
            $result = $this->comentariosModel->deleteComentario($id_comentario);
            if (!$result) {
                return $this->json_response("no especifica accion", 300);
            }
            else {
                return $this->json_response($result, 200);
            }
            
        }
        else {
            return $this->json_response("no especifica accion", 300);
        }
    }
}