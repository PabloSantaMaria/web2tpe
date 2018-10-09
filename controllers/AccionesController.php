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

  

  function update($params) {
    $id_accion = $params[0];
    //como se que campo cambiar?:
    //desde la db traigo los valores actuales
    $accion = $this->model->getAccion($id_accion); 
    // y se los muestro al usuario en la view
    $this->view->mostrarAccion($accion);
    //en el view muestro un form con los datos completos de esa accion
    //para eso, tengo que poner en el value=" " de cada input, el valor de la db

    //$this->model->updateAccion($id_accion);
    
    //no voy a volver a home, voy a ir a otra vista que sea el form
    //despues hacer otro metodo que sea actualizar, que hace el update en la db
    //header("Location: http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']));
  }
}
?>