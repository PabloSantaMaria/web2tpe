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
}

 ?>
