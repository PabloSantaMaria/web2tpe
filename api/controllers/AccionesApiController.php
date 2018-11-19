<?php
require_once "api/Api.php";
require_once 'models/AccionModel.php';

class AccionesApiController extends Api {
    private $accionesModel;
    
    function __construct(){
        parent::__construct();
        $this->accionesModel = new AccionModel();
    }
    
    function detalleAccion($param) {
        $id_accion = $param[0];
        $data = $this->accionesModel->fetchAccion($id_accion);
        if (isset($data)) {
            return $this->json_response($data, 200);
        }
        else {
            return $this->json_response(null, 404);
        }
    }
}