<?php
require_once "./views/AdminView.php";
require_once "./models/AdminModel.php";
require_once "./controllers/SecureController.php";

class AdminController extends SecureController {
  private $view;
  private $model;

  function __construct() {
    parent::__construct();
    $this->view = new AdminView();
    $this->model = new AdminModel();
    
  }

  function adminHome() {
    $regiones = $this->model->fetchRegiones();
    $paises = $this->model->fetchPaises();
    $this->view->adminHome($regiones, $paises);
  }

  function adminDisplay() {
    if (isset($_POST["region"])) {
      $region = $_POST["region"];
      $acciones = $this->model->fetchRegion($region);
    }
    if (isset($_POST["pais"])) {
      $pais = $_POST["pais"];
      $acciones = $this->model->fetchPais($pais);
    }
    
    $regiones = $this->model->fetchRegiones();
    $paises = $this->model->fetchPaises();
    
    $this->view->adminDisplay($regiones, $paises, $acciones);
  }
}
?>