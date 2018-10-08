<?php
require_once "./views/NavView.php";

class NavController {
  private $view;

  function __construct() {
    $this->view = new NavView();
  }

  function home() {
    $this->view->home();
  }
  function operar() {
    $this->view->operar();
  }
  function acerca() {
    $this->view->acerca();
  }
}
?>