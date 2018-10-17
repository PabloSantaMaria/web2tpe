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
  function acerca() {
    $this->view->acerca();
  }
}
?>