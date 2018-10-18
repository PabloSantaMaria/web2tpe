<?php
require_once "./views/NavView.php";
require_once "./models/NavModel.php";

class NavController {
  protected $view;
  protected $model;
  protected $regiones;
  
  /**
   * inicializa las regiones que puede ver el visitante
   */
  function __construct() {
    $this->view = new NavView();
    $this->model = new NavModel();
    $this->regiones = $this->model->fetchRegiones();
  }
  /**
   * muestra página principal
   */
  function home() {
    $title = 'Home';
    $this->view->home($title, $this->regiones);
  }
  /**
   * trae y muestra las cotizaciones de la región que eligió el visitante
   */
  function displayCotizaciones($params) {
    if ($params[0] == '') {
      $region = 'todas las regiones';
      $title = 'Todas las cotizaciones';
      $acciones = $this->model->fetchAll();
    }
    else {
      $region = $params[0];
      $title = 'Cotizaciones de ' . $region;
      $acciones = $this->model->fetchRegion($region);
    }
    $this->view->displayCotizaciones($title, $acciones, $this->regiones, $region);
  }
  /**
   * muestra página acerca de nosotros
   */
  function acerca() {
    $title = 'Acerca de nosotros';
    $this->view->acerca($title, $this->regiones);
  }
}
?>