<?php
require_once "./views/NavView.php";
require_once "./controllers/AccionesController.php";

class NavController {
  private $view;
  private $controller;

  function __construct() {
    $this->view = new NavView();
  }

  function home() {
    $this->view->home();
  }
  function cotizaciones() {
    $this->controller = new AccionesController();
    $this->controller->getAcciones();
  }
  function operar() {
    $this->view->operar();
  }
  function acerca() {
    $this->view->acerca();
  }
}
?>