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
        if ($data != null) {
            return $this->json_response($data, 200);
        }
        else {
            return $this->json_response("no existe", 404);
        }
    }
    
    function deleteAccion($param) {
        if (isset($param)) {
            $id_accion = $param[0];
            $result = $this->accionesModel->deleteAccion($id_accion);
            if (!$result) {
                return $this->json_response("no especifica accion", 300);
            }
            return $this->json_response($result, 200);
        }
        else {
            return $this->json_response("no especifica accion", 300);
        }
    }
    
    function updateAccion($param) {
        if (isset($param)) {
            $id_accion = $param[0];
            $body = $this->getData();
            if (isset($body)) {
                $accion = $body->accion;
                $id_pais = $body->id_pais;
                $precio = $body->precio;
                $variacion = $body->variacion;
                $volumen = $body->volumen;
                $maximo = $body->maximo;
                $minimo = $body->minimo;
                $result = $this->accionesModel->updateAccion($id_accion, $accion, $id_pais, $precio, $variacion, $volumen, $maximo, $minimo);
                return $this->json_response($result, 200);
            }
        }
        else {
            return $this->json_response("Internal Error", 500);
        }
    }
    
    function insertAccion() {
        $body = $this->getData();
        if (isset($body)) {
            $accion = $body->accion;
            $id_pais = $body->id_pais;
            $precio = $body->precio;
            $variacion = $body->variacion;
            $volumen = $body->volumen;
            $maximo = $body->maximo;
            $minimo = $body->minimo;
            $result = $this->accionesModel->insertAccion($accion, $id_pais, $precio, $variacion, $volumen, $maximo, $minimo);
            return $this->json_response($result, 200);
        }
        else {
            return $this->json_response("Internal Error", 500);
        }
        
        
    }
}