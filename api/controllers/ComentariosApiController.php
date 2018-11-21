<?php
require_once "api/Api.php";
require_once 'models/ComentarioModel.php';

class ComentariosApiController extends Api {
    private $comentariosModel;
    
    function __construct(){
        parent::__construct();
        $this->comentariosModel = new ComentarioModel();
    }
    
    function comentariosAccion($param) {
        $id_accion = $param[0];
        $data = $this->comentariosModel->getComentarios($id_accion);
        if ($data != null) {
            return $this->json_response($data, 200);
        }
        else {
            return $this->json_response("No existen comentarios", 404);
        }
    }
    
    function deleteComentario($param) {
        if (isset($param)) {
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