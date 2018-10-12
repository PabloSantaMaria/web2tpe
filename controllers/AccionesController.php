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

  function getAcciones() {
    $acciones = $this->model->getAcciones();
    $this->view->mostrarAcciones($acciones);
  }

  function getRegion($params) {
    $region = $params[0];
    $acciones = $this->model->getRegion($region);
    $this->view->mostrarAcciones($acciones);
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

    $this->model->insertAccion($region, $pais, $accion, $precio, $variacion, $volumen, $maximo, $minimo);
  }

  function editar($params) {
    $id_accion = $params[0];
    $accion = $this->model->getAccion($id_accion);
    $this->view->mostrarEditar($accion);
  }

  function updateRegistro(){
    $id_accion = $_POST["id_accion"];
    $accion = $_POST["editNombre"];
    $precio = $_POST["editPrecio"];
    $variacion = $_POST["editVariacion"];
    $volumen = $_POST["editVolumen"];
    $maximo = $_POST["editMaximo"];
    $minimo = $_POST["editMinimo"];

    $this->model->updateAccion($id_accion, $accion, $precio, $variacion, $volumen, $maximo, $minimo);
    $accion = $this->model->getAccion($id_accion);
    $this->view->mostrarEditar($accion);
  }      

  function deleteAccion($params) {
    $id_accion = $params[0];
    $this->model->deleteAccion($id_accion);
    $this->getAcciones();
  }

  // function test() {
  //   $this->model->test();
  // }

}
?>