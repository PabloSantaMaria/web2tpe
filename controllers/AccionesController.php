<?php
require_once "./views/AccionesView.php";
require_once "./models/AccionesModel.php";

class AccionesController {
  private $view;
  private $model;

  function __construct() {
    $this->view = new AccionesView();
    $this->model = new AccionesModel();
  }
  
  function getAll() {
    $acciones = $this->model->fetchAll();
    $this->view->displayAcciones($acciones);
  }

  function getRegion($params) {
    $region = $params[0];
    $acciones = $this->model->fetchRegion($region);
    $this->view->displayAcciones($acciones);
  }

  function editAccion($params) {
    $id_accion = $params[0];
    $accion = $this->model->fetchAccion($id_accion);
    $this->view->displayUpdateForm($accion);
  }

  function updateAccion(){
    $id_accion = $_POST["id_accion"];
    $accion = $_POST["editNombre"];
    $precio = $_POST["editPrecio"];
    $variacion = $_POST["editVariacion"];
    $volumen = $_POST["editVolumen"];
    $maximo = $_POST["editMaximo"];
    $minimo = $_POST["editMinimo"];

    $this->model->updateAccion($id_accion, $accion, $precio, $variacion, $volumen, $maximo, $minimo);
    $accion = $this->model->fetchAccion($id_accion);
    $this->view->displayUpdateForm($accion);
  } 

  function insertAccion() {
    $region = $_POST["region"];
    $pais = $_POST["pais"];
    $accion = $_POST["accion"];
    $precio = $_POST["precio"];
    $variacion = $_POST["variacion"];
    $volumen = $_POST["volumen"];
    $maximo = $_POST["maximo"];
    $minimo = $_POST["minimo"];

    if ($this->existePais($pais)) {
      $id_pais = $this->getID("pais", $pais);
      $this->model->insertAccion($id_pais, $accion, $precio, $variacion, $volumen, $maximo, $minimo);
    }
    else {
      $id_region = $this->getID("region", $region);
      $this->model->insertPais($pais, $id_region);
      $id_pais = $this->getID("pais", $pais);
      $this->model->insertAccion($id_pais, $accion, $precio, $variacion, $volumen, $maximo, $minimo);
    }

    $id_accion = $this->model->getID("accion", $accion);
    $accionGuardada = $this->model->fetchAccion($id_accion);
    $this->view->displayAcciones($accionGuardada);
  }

  function deleteAccion($params) {
    $id_accion = $params[0];
    $this->model->deleteAccion($id_accion);
    //muestra todas!
    //tendría que mostrar la región desde donde se borró
    $this->getAll();
  }

  private function existePais($pais) {
    return $this->model->existePais($pais);
  }
  private function getID($tabla, $item) {
    return $this->model->getID($tabla, $item);
  }
}
?>