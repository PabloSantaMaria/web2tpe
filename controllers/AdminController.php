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
    $mensaje = "En esta sección puede ver y modificar cotizaciones";
    $this->view->adminHome($regiones, $paises, $mensaje);
  }

  function adminDisplay() {
    if (isset($_POST["region"])) {
      $region = $_POST["region"];
      $acciones = $this->model->fetchRegion($region);
    }
    elseif (isset($_POST["pais"])) {
      $pais = $_POST["pais"];
      $acciones = $this->model->fetchPais($pais);
    }
    else {
      $acciones = $this->model->fetchAll();
    }
    
    $regiones = $this->model->fetchRegiones();
    $paises = $this->model->fetchPaises();
    $mensaje = "Registros traídos con éxito";
    
    $this->view->adminDisplay($regiones, $paises, $acciones, $mensaje);
  }

  function guardar() {
    if (isset($_POST["nuevaRegion"])) {
      $region = $_POST["nuevaRegion"];
      if ($this->existeItem("region", $region)) {
      // $id_pais = $this->getID("pais", $pais);
      // $this->model->insertAccion($id_pais, $accion, $precio, $variacion, $volumen, $maximo, $minimo);
      }
      else {
      $this->model->insertRegion($region);
      // $id_region = $this->getID("region", $region);
      // $this->model->insertAccion($id_pais, $accion, $precio, $variacion, $volumen, $maximo, $minimo);
      }
    }
    elseif (isset($_POST["nuevoPais"])) {
      $pais = $_POST["nuevoPais"];
      if ($this->existeItem("pais", $pais)) {
      // $id_pais = $this->getID("pais", $pais);
      // $this->model->insertAccion($id_pais, $accion, $precio, $variacion, $volumen, $maximo, $minimo);
      }
      else {
      $region = $_POST['perteneceRegion'];
      $id_region = $this->getID("region", $region);
      $this->model->insertPais($pais, $id_region);
      
      // $this->model->insertAccion($id_pais, $accion, $precio, $variacion, $volumen, $maximo, $minimo);
      }
    }
    elseif (isset($_POST["paisAccion"]) & isset($_POST["accionAccion"]) & isset($_POST["precioAccion"]) & isset($_POST["variacionAccion"]) & isset($_POST["volumenAccion"]) & isset($_POST["maximoAccion"]) & isset($_POST["minimoAccion"])) {
      $pais = $_POST["paisAccion"];
      $id_pais = $this->getID("pais", $pais);
      $accion = $_POST["accionAccion"];
      $precio = $_POST["precioAccion"];
      $variacion = $_POST["variacionAccion"];
      $volumen = $_POST["volumenAccion"];
      $maximo = $_POST["maximoAccion"];
      $minimo = $_POST["minimoAccion"];
      $this->model->insertAccion($id_pais, $accion, $precio, $variacion, $volumen, $maximo, $minimo);
    }
    elseif (isset($_POST["nuevoUser"]) & isset($_POST["nuevaPass"])) {
      $user = $_POST["nuevoUser"];
      if ($this->existeItem("usuario", $user)) {
      // $id_pais = $this->getID("pais", $pais);
      // $this->model->insertAccion($id_pais, $accion, $precio, $variacion, $volumen, $maximo, $minimo);
      }
      else {
        $pass = $_POST["nuevaPass"];
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $this->model->insertUsuario($user, $hash);
      
      // $this->model->insertAccion($id_pais, $accion, $precio, $variacion, $volumen, $maximo, $minimo);
      }
    }elseif (isset($_POST["userBorrar"]) & isset($_POST["passBorrar"])) {
      $user = $_POST["userBorrar"];
      if ($this->existeItem("usuario", $user)) {
        $pass = $_POST['passBorrar'];
        $dbUser = $this->model->fetchUser($user);
        if (password_verify($pass, $dbUser['pass'])) {
            $this->model->deleteUser($user);
        }
      }
      else {
      // $this->model->insertAccion($id_pais, $accion, $precio, $variacion, $volumen, $maximo, $minimo);
      }
    }

    // $id_accion = $this->model->getID("accion", $accion);
    // $accionGuardada = $this->model->fetchAccion($id_accion);
    // $this->view->displayAcciones($accionGuardada);
  }

  function editAccion($params) {
    $id_accion = $params[0];
    $accion = $this->model->fetchAccion($id_accion);
    $paises = $this->model->fetchPaises();
    $this->view->displayUpdateForm($accion, $paises);
  }

  function updateAccion(){
    $id_accion = $_POST["id_accion"];
    $accion = $_POST["editNombre"];
    $pais = $_POST["editPais"];
    $id_pais = $this->getID("pais", $pais);
    $precio = $_POST["editPrecio"];
    $variacion = $_POST["editVariacion"];
    $volumen = $_POST["editVolumen"];
    $maximo = $_POST["editMaximo"];
    $minimo = $_POST["editMinimo"];

    $this->model->updateAccion($id_accion, $accion, $id_pais, $precio, $variacion, $volumen, $maximo, $minimo);
    $accion = $this->model->fetchAccion($id_accion);
    $paises = $this->model->fetchPaises();
    $this->view->displayUpdateForm($accion, $paises);
  }

  private function existeItem($tabla, $item) {
    return $this->model->existeItem($tabla, $item);
  }
  private function getID($tabla, $item) {
    return $this->model->getID($tabla, $item);
  }
}
?>