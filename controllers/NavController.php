<?php
require_once "./views/NavView.php";
require_once "./models/NavModel.php";

class NavController {
  private $view;
  private $model;
  private $regiones;

  function __construct() {
    $this->view = new NavView();
    $this->model = new NavModel();
    $this->regiones = $this->model->fetchRegiones();
  }
  function home() {
    $title = 'Home';
    $this->view->home($title, $this->regiones);
  }
  function displayCotizaciones($params) {
    if ($params[0] == '') {
      $title = 'Todas las cotizaciones';
      $acciones = $this->model->fetchAll();
    }
    else {
      $region = $params[0];
      $title = 'Cotizaciones de ' . $region;
      $acciones = $this->model->fetchRegion($region);
    }
    $this->view->displayCotizaciones($title, $acciones, $this->regiones);
  }
  function acerca() {
    $title = 'Acerca de nosotros';
    $this->view->acerca($title, $this->regiones);
  }
}
?>