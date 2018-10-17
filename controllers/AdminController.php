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
    $this->actualizarDropdowns();
    $mensaje = "En esta sección puede ver y modificar cotizaciones";
    $this->view->adminHome($this->regiones, $this->paises, $mensaje);
  }

  function adminControl($params) {
    switch ($params[0]) {
      case 'region':
        # code...
        break;
      case 'pais':
        # code...
        break;
      case 'todas':
        # code...
        break;
      case 'guardarRegion':
        # code...
        break;
      case 'guardarPais':
        # code...
        break;
      case 'guardarAccion':
        # code...
        break;
      case 'guardarUsuario':
        # code...
        break;
      case 'borrarUsuario':
        # code...
        break;
      
      default:
        # code...
        break;
    }



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
          $acciones = $this->model->fetchRegion($region);
          $this->mensaje = "La región " . $region . " ya existe en la base de datos";
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
          $acciones = $this->model->fetchPais($pais);
          $this->mensaje = "El país " . $pais . " ya existe en la base de datos";
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
    if ($params[0] == "guardarAccion") {
      if (isset($_POST["paisAccion"]) & isset($_POST["accionAccion"]) & isset($_POST["precioAccion"]) & isset($_POST["variacionAccion"]) & isset($_POST["volumenAccion"]) & isset($_POST["maximoAccion"]) & isset($_POST["minimoAccion"])) {
        $accion = $_POST["accionAccion"];
        if ($this->existeItem("accion", $accion)) {
          $id_accion = $this->getID("accion", $accion);
          $acciones = $this->model->fetchAccion($id_accion);
          $this->mensaje = "El registro " . $accion . " ya existe en la base de datos";
        }
        else {
          $pais = $_POST["paisAccion"];
          $id_pais = $this->getID("pais", $pais);
          $precio = $_POST["precioAccion"];
          $variacion = $_POST["variacionAccion"];
          $volumen = $_POST["volumenAccion"];
          $maximo = $_POST["maximoAccion"];
          $minimo = $_POST["minimoAccion"];
          $this->model->insertAccion($id_pais, $accion, $precio, $variacion, $volumen, $maximo, $minimo);
          $id_accion = $this->getID("accion", $accion);
          $acciones = $this->model->fetchAccion($id_accion);
          $this->mensaje = "Acción " . $accion . " agregada con éxito";
        }
      }
    }
    if ($params[0] == "guardarUsuario") {
      if (isset($_POST["nuevoUser"]) & isset($_POST["nuevaPass"])) {
        $user = $_POST["nuevoUser"];
        if ($this->existeItem("usuario", $user)) {
          header(ADMIN);
          $this->mensaje = "El usuario " . $user . " ya existe en la base de datos";
        }
        else {
          $pass = $_POST["nuevaPass"];
          $hash = password_hash($pass, PASSWORD_DEFAULT);
          $this->model->insertUsuario($user, $hash);
          header(ADMIN);
        }
      }
    }
    if ($params[0] == "borrarUsuario") {
      if (isset($_POST["userBorrar"]) & isset($_POST["passBorrar"])) {
        $user = $_POST["userBorrar"];
        if ($this->existeItem("usuario", $user)) {
          $pass = $_POST['passBorrar'];
          $dbUser = $this->model->fetchUser($user);
          if (password_verify($pass, $dbUser['pass'])) {
            $this->model->deleteUser($user);
            header(ADMIN);
            $this->mensaje = "El usuario " . $user . " ha sido borrado";
          }
        }
        else {
          $this->mensaje = "El usuario " . $user . " no existe en la base de datos";
          header(ADMIN);
        }
      }
    }
    
    $this->actualizarDropdowns();
    $this->view->adminDisplay($this->regiones, $this->paises, $acciones, $this->mensaje);
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