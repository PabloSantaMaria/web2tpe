<?php
require_once "./views/AdminView.php";
require_once "./models/AdminModel.php";
require_once "./controllers/SecureController.php";

class AdminController extends SecureController {
  private $view;
  private $model;
  private $regiones;
  private $paises;
  private $mensaje = '';

  function __construct() {
    parent::__construct();
    $this->view = new AdminView();
    $this->model = new AdminModel();
    $this->regiones = $this->model->fetchRegiones();
    $this->paises = $this->model->fetchPaises();
  }

  function adminHome() {
    $regiones = $this->model->fetchRegiones();
    $paises = $this->model->fetchPaises();
    $mensaje = "En esta sección puede ver y modificar cotizaciones";
    $this->view->adminHome($regiones, $paises, $mensaje);
  }

  function adminDisplay($params) {
    //refactorear a funciones privadas
    if ($params[0] == "region") {
      if (isset($_POST["region"])) {
      $region = $_POST["region"];
      $acciones = $this->model->fetchRegion($region);
      $this->mensaje = "Mostrando registros de " . $region;
      }
    }
    if ($params[0] == "pais") {
      if (isset($_POST["pais"])) {
      $pais = $_POST["pais"];
      $acciones = $this->model->fetchPais($pais);
      $this->mensaje = "Mostrando registros de " . $pais;
      }
    }
    if ($params[0] == "todas") {
      $acciones = $this->model->fetchAll();
      $this->mensaje = "Mostrando todos los registros";
    }
    if ($params[0] == "guardarRegion") {
      if (isset($_POST["nuevaRegion"])) {
        $region = $_POST["nuevaRegion"];
        if ($this->existeItem("region", $region)) {
          //todo
        }
        else {
          $this->model->insertRegion($region);
          $acciones = $this->model->fetchRegion($region);
          $this->mensaje = "Región " . $region . " agregada con éxito";
        }
      }
    }
    if ($params[0] == "guardarPais") {
      if (isset($_POST["nuevoPais"])) {
        $pais = $_POST["nuevoPais"];
        if ($this->existeItem("pais", $pais)) {
          //todo
        }
        else {
          $region = $_POST['perteneceRegion'];
          $id_region = $this->getID("region", $region);
          $this->model->insertPais($pais, $id_region);
          $acciones = $this->model->fetchPais($pais);
          $this->mensaje = "País " . $pais . " agregado con éxito";
        }
      }
    }
    $this->actualizarDropdowns();
    $this->view->adminDisplay($this->regiones, $this->paises, $acciones, $this->mensaje);
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

  function deleteAccion($params) {
    $id_accion = $params[0];
    $this->model->deleteAccion($id_accion);
    $this->mensaje = "Registro borrado con éxito";
    $this->actualizarDropdowns();
    $this->view->adminHome($this->regiones, $this->paises, $this->mensaje);
  }

  private function existeItem($tabla, $item) {
    return $this->model->existeItem($tabla, $item);
  }
  private function getID($tabla, $item) {
    return $this->model->getID($tabla, $item);
  }
  private function actualizarDropdowns() {
    $this->regiones = $this->model->fetchRegiones();
    $this->paises = $this->model->fetchPaises();
  }
}
?>