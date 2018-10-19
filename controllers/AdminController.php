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

  /**
   * inicializa regiones, paises y mensaje default
   */
  function __construct() {
    parent::__construct();
    $this->view = new AdminView();
    $this->model = new AdminModel();
    $this->regiones = $this->model->fetchRegiones();
    $this->paises = $this->model->fetchPaises();
    $this->mensaje = 'Administrar datos';
  }
  /**
   * home de admin
   */
  function adminHome() {
    $this->actualizarDropdowns();
    $this->view->adminHome($this->regiones, $this->paises, $this->mensaje);
  }
  /**
   * opciones de control de admin
   * llegan por url
   */
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
  /**
   * muestra todas las acciones de una región
   */
  private function verRegion($region){
    $this->acciones = $this->model->fetchRegion($region);
    $this->actualizarMensaje("verRegion", $region);
  }
  /**
   * muestra todas las acciones de un país
   */
  private function verPais($pais){
    $this->acciones = $this->model->fetchPais($pais);
    $this->actualizarMensaje("verPais", $pais);
  }
  /**
   * muestra todas las acciones
   */
  private function verTodas(){
    $this->acciones = $this->model->fetchAll();
    $this->actualizarMensaje("verTodas", '');
  }
  /**
   * guarda una región nueva
   * verifica si ya existe
   */
  private function guardarRegion($region){
    if ($this->existeItem("region", $region)) {
      $this->acciones = $this->model->fetchRegion($region);
      $this->actualizarMensaje("guardarRegionExistente", $region);
    }
    else {
      $this->model->insertRegion($region);
      $this->acciones = $this->model->fetchRegion($region);
       $this->actualizarMensaje("guardarRegion", $region);
    }
  }
  /**
   * guarda un país nuevo en la región elegida
   * no se puede elegir una región inexistente
   * verifica si ya existe
   */
  private function guardarPais($pais){
    if ($this->existeItem("pais", $pais)) {
      $this->acciones = $this->model->fetchPais($pais);
      $this->actualizarMensaje("guardarPaisExistente", $pais);
    }
    else {
      $region = $_POST['perteneceRegion'];
      $id_region = $this->getID("region", $region);
      $this->model->insertPais($pais, $id_region);
      $this->acciones = $this->model->fetchPais($pais);
      $this->actualizarMensaje("guardarPais", $pais);
    }
  }
  /**
   * guarda una nueva acción en el país elegido
   * no se puede elegir un país inexistente
   * el país ya pertenece a una región
   * verifica que no exista el nombre de la acción
   */
  private function guardarAccion($accion){
    if ($this->existeItem("accion", $accion)) {
      $id_accion = $this->getID("accion", $accion);
      $this->acciones = $this->model->fetchAccion($id_accion);
     $this->actualizarMensaje("guardarAccionExistente", $accion);
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
      $this->actualizarMensaje("guardarAccion", $accion);
    }
  }
  /**
   * guarda un nuevo usuario administrador
   * encripta la contraseña
   * verifica que no exista el mismo nombre
   */
  private function guardarUsuario($user){
    if ($this->existeItem("usuario", $user)) {
      $this->actualizarMensaje("usuarioExistente", $user);
      $this->adminHome();
    }
    else {
      $pass = $_POST["nuevaPass"];
      $hash = password_hash($pass, PASSWORD_DEFAULT);
      $this->model->insertUsuario($user, $hash);
      $this->actualizarMensaje("guardarUsuario", $user);
      $this->adminHome();
    }
  }
  /**
   * borra un usuario si existe y si se sabe la contraseña
   */
  private function borrarUsuario($user){
    if ($this->existeItem("usuario", $user)) {
      $pass = $_POST['passBorrar'];
      $dbUser = $this->model->fetchUser($user);
      if (password_verify($pass, $dbUser['pass'])) {
        $this->model->deleteUser($user);
        $this->actualizarMensaje("borrar", $user);
        $this->adminHome();
      }
    }
    else {
      $this->actualizarMensaje("noExiste", $user);
      $this->adminHome();
    }
  }
  /**
   * muestra los datos de una acción para editarla
   */
  function editAccion($params) {
    $id_accion = $params[0];
    $accion = $this->model->fetchAccion($id_accion);
    $paises = $this->model->fetchPaises();
    $this->view->displayUpdateForm($accion, $paises);
  }
  /**
   * actualiza una acción
   * vuelve al form para seguir editándola si es necesario
   */
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
  /**
   * borra una acción
   * muestra las acciones de la región a la que pertenecía
   */
  function deleteAccion($params) {
    $id_accion = $params[0];
    $pais = $this->model->fetchAccion($id_accion)[0]['pais'];
    $region = $this->model->fetchRegionDePais($pais)[0]['region'];
    $this->model->deleteAccion($id_accion);
    $this->mensaje = "Registro borrado con éxito";
    $this->actualizarDropdowns();
    $acciones = $this->model->fetchRegion($region);
    $this->view->adminDisplay($this->regiones, $this->paises, $acciones, $this->mensaje);
  }
  /**
   * borra una región
   * primero borra todas las acciones que pertenecen a los países de la región
   * luego borra todos los países que pertenecen a la región
   */
  function deleteRegion() {
    $region = $_POST['borrarRegion'];
    $acciones = $this->model->fetchRegion($region);
    $paises = $this->model->fetchPaisesPorRegion($region);
    $id_region = $this->getID('region', $region);
    foreach ($acciones as $accion) {
      $this->model->deleteAccion($accion['id_accion']);
    }foreach ($paises as $pais) {
      $this->model->deletePais($pais['id_pais']);
    }
    $this->model->deleteRegion($id_region);
    $this->mensaje = 'Se borró la región y todos los registros asociados';
    $this->adminHome();
  }
  /**
   * función auxiliar que actualiza el mensaje para el usuario
   */
  private function actualizarMensaje($caso, $item) {
    switch ($caso) {
      case 'borrar':
        $this->mensaje = "El usuario " . $item . " ha sido borrado";
        break;
      case 'verRegion':
        $this->mensaje = "Mostrando registros de " . $item ;
        break;
      case 'verPais':
        $this->mensaje = "Mostrando registros de " . $item;
        break;
      case 'verTodas':
        $this->mensaje = "Mostrando todos los registros";
        break;
      case 'guardarRegionExistente':
        $this->mensaje = "La región " . $item . " ya existe en la base de datos. Mostrando registros de la región";
        break;
      case 'guardarRegion':
        $this->mensaje = "Región " . $item . " agregada con éxito";
        break;
      case 'guardarPaisExistente':
        $this->mensaje = "El país " . $item . " ya existe en la base de datos";
        break;
      case 'guardarPais':
        $this->mensaje = "País " . $item . " agregado con éxito";
        break;
      case 'guardarAccionExistente':
        $this->mensaje = "El registro " . $item . " ya existe en la base de datos";
        break;
      case 'guardarAccion':
        $this->mensaje = "Acción " . $item . " agregada con éxito";
        break;
      case 'guardarUsuario':
        $this->mensaje = "El usuario " . $item . " ha sido agregado con éxito";
        break;
      case 'noExiste':
        $this->mensaje = "El usuario " . $item . " no existe en la base de datos";
        break;
      case 'usuarioExistente':
        $this->mensaje = "El usuario " . $item . " ya existe en la base de datos";
        break;
    }
  }
  /**
   * función auxiliar que devuelve si un dato existe en una tabla
   */
  private function existeItem($tabla, $item) {
    return $this->model->existeItem($tabla, $item);
  }
  /**
   * función auxiliar que devuelve el id de un registro
   */
  private function getID($tabla, $item) {
    return $this->model->getID($tabla, $item);
  }
  /**
   * actualiza las regiones y los países existentes en la db para poder elegirlos en dropdowns
   */
  private function actualizarDropdowns() {
    $this->regiones = $this->model->fetchRegiones();
    $this->paises = $this->model->fetchPaises();
  }
}
?>