<?php
require_once "./views/AccionesView.php";
require_once "./models/AccionesModel.php";

class AccionesController {
  private $view;
  private $model;

  function __construct() {
    $this->view = new AccionesView();
    $this->model = new AccionesModel();
  }

  function getAcciones() {
    $acciones = $this->model->getAcciones();
    $this->view->mostrarAcciones($acciones);
  }

  function getRegion($params) {
    $region = $params[0];
    $acciones = $this->model->getRegion($region);
    $this->view->mostrarAcciones($acciones);
  }

  function editar($params) {
    $id_accion = $params[0];
    $accion = $this->model->getAccion($id_accion);
    $this->view->mostrarEditar($accion);
    //como se que campo cambiar?:
    //desde la db traigo los valores actuales
   
    // y se los muestro al usuario en la view
    
    //en el view muestro un form con los datos completos de esa accion
    //para eso, tengo que poner en el value=" " de cada input, el valor de la db

    //$this->model->updateAccion($id_accion);
    
    //no voy a volver a home, voy a ir a otra vista que sea el form
    //despues hacer otro metodo que sea actualizar, que hace el update en la db
    //header("Location: http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']));
  }

  function updateRegistro(){
    $id_accion = $_POST["id_accion"];
    $accion = $_POST["editNombre"];
    // $pais = $_POST["editPais"];
    $precio = $_POST["editPrecio"];
    $variacion = $_POST["editVariacion"];
    $volumen = $_POST["editVolumen"];
    $maximo = $_POST["editMaximo"];
    $minimo = $_POST["editMinimo"];

    $this->model->updateAccion($id_accion, $accion, $precio, $variacion, $volumen, $maximo, $minimo);
    $accion = $this->model->getAccion($id_accion);
    $this->view->mostrarEditar($accion);

    //$this->view->mostrarEditar($id_accion);
  }      
   
   
    
  

  function deleteAccion($params) {
    $id_accion = $params[0];
    $this->model->deleteAccion($id_accion);
    $this->getAcciones();
    //header("Location: http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']));
  }

  //estoy probando solo con 2 campos
  function insert() {
    //poner los isset
    $nombre = $_POST['nombre']; //name del input
    $precio = $_POST['precio'];

    $this->model->insertAccion($nombre, $precio);

    header("Location: http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']));
  }

  

  
}
?>