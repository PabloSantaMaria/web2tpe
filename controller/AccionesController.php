<?php
require_once "./view/AccionesView.php";
require_once "./model/AccionesModel.php";

class AccionesController {
  private $view;
  private $model;

  function __construct() {
    $this->view = new AccionesView();
    $this->model = new AccionesModel();
  }

  function home() {
    $acciones = $this->model->getAcciones();
    $this->view->mostrar($acciones);
  }
  
  //estoy probando solo con 2 campos
  function insert() {
    //poner los isset
    $nombre = $_POST['nombre']; //name del input
    $precio = $_POST['precio'];

    $this->model->insertAccion($nombre, $precio);

    header("Location: http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']));
  }
}
?>