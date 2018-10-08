<?php
require_once "./views/NavView.php";

class NavController {
  private $view;
  private $model;

  function __construct() {
    $this->view = new NavView();
  }

  function home() {
    $this->view->home();
  }
}
?>