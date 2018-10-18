<?php
require_once "./views/AdminView.php";
require_once "./models/AdminModel.php";
require_once "./controllers/SecureController.php";

class AdminController extends SecureController {
  private $view;
  private $model;
  private $regiones;
  private $paises;
  private $acciones;
  private $mensaje;

  function __construct() {
    parent::__construct();
    $this->view = new AdminView();
    $this->model = new AdminModel();
    $this->regiones = $this->model->fetchRegiones();
    $this->paises = $this->model->fetchPaises();
    $this->mensaje = '';
  }

  function adminHome() {
    $this->actualizarDropdowns();
    $mensaje = "En esta sección puede ver y modificar cotizaciones";
    $this->view->adminHome($this->regiones, $this->paises, $mensaje);
  }

  function adminControl($params) {
    switch ($params[0]) {
      case 'verRegion':
        if (isset($_POST["region"])) {
          $region = $_POST["region"];
          $this->verRegion($region);
        }
        break;
      case 'verPais':
        if (isset($_POST["pais"])) {
          $pais = $_POST["pais"];
          $this->verPais($pais);
        }
        break;
      case 'verTodas':
        $this->verTodas();
        break;
      case 'guardarRegion':
        if (isset($_POST["nuevaRegion"])) {
          $region = $_POST["nuevaRegion"];
          $this->guardarRegion($region);
        }
        break;
      case 'guardarPais':
        if (isset($_POST["nuevoPais"]) && isset($_POST["perteneceRegion"])) {
          $pais = $_POST["nuevoPais"];
          $this->guardarPais($pais);
        }
        break;
      case 'guardarAccion':
        if (isset($_POST["paisAccion"]) & isset($_POST["accionAccion"]) & isset($_POST["precioAccion"]) & isset($_POST["variacionAccion"]) & isset($_POST["volumenAccion"]) & isset($_POST["maximoAccion"]) & isset($_POST["minimoAccion"])) {
          $accion = $_POST["accionAccion"];
          $this->guardarAccion($accion);
        }
        break;
      case 'guardarUsuario':
        if (isset($_POST["nuevoUser"]) & isset($_POST["nuevaPass"])) {
          $user = $_POST["nuevoUser"];
          $this->guardarUsuario($user);
        }
        break;
      case 'borrarUsuario':
        if (isset($_POST["userBorrar"]) & isset($_POST["passBorrar"])) {
          $user = $_POST["userBorrar"];
          $this->borrarUsuario($user);
        }
        break;
      default:
        header(ADMIN);
        break;
    }
    $this->actualizarDropdowns();
    $this->view->adminDisplay($this->regiones, $this->paises, $this->acciones, $this->mensaje);
  }

  private function verRegion($region){
    $this->acciones = $this->model->fetchRegion($region);
    $this->mensaje = "Mostrando registros de " . $region;
  }
  private function verPais($pais){
    $this->acciones = $this->model->fetchPais($pais);
    $this->mensaje = "Mostrando registros de " . $pais;
  }
  private function verTodas(){
    $this->acciones = $this->model->fetchAll();
    $this->mensaje = "Mostrando todos los registros";
  }
  private function guardarRegion($region){
    if ($this->existeItem("region", $region)) {
      $this->acciones = $this->model->fetchRegion($region);
      $this->mensaje = "La región " . $region . " ya existe en la base de datos. Mostrando registros de la región";
    }
    else {
      $this->model->insertRegion($region);
      $this->acciones = $this->model->fetchRegion($region);
      $this->mensaje = "Región " . $region . " agregada con éxito";
    }
  }
  private function guardarPais($pais){
    if ($this->existeItem("pais", $pais)) {
      $this->acciones = $this->model->fetchPais($pais);
      $this->mensaje = "El país " . $pais . " ya existe en la base de datos";
    }
    else {
      $region = $_POST['perteneceRegion'];
      $id_region = $this->getID("region", $region);
      $this->model->insertPais($pais, $id_region);
      $this->acciones = $this->model->fetchPais($pais);
      $this->mensaje = "País " . $pais . " agregado con éxito";
    }
  }
  private function guardarAccion($accion){
    if ($this->existeItem("accion", $accion)) {
      $id_accion = $this->getID("accion", $accion);
      $this->acciones = $this->model->fetchAccion($id_accion);
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
      $this->acciones = $this->model->fetchAccion($id_accion);
      $this->mensaje = "Acción " . $accion . " agregada con éxito";
    }
  }
  private function guardarUsuario($user){
    if ($this->existeItem("usuario", $user)) {
      $this->mensaje = "El usuario " . $user . " ya existe en la base de datos";
      header(ADMIN);
    }
    else {
      $pass = $_POST["nuevaPass"];
      $hash = password_hash($pass, PASSWORD_DEFAULT);
      $this->model->insertUsuario($user, $hash);
      $this->mensaje = "El usuario " . $user . " ha sido agregado con éxito";
      header(ADMIN);
    }
  }
  private function borrarUsuario($user){
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