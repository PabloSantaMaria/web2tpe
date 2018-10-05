<?php
require_once "controller/AccionesController.php";

$controller = new AccionesController();

// localhost/web2tpe/action/id_accion
//                     [0]    [1]
$url = explode('/', $_GET['action']);

if ($url[0] == '') {
  $controller->home();
}
else {
  if ($url[0] == 'agregar') {
    $controller->insert();
  }
  elseif ($url[0] == 'borrar') {
    $controller->delete($url[1]);
  }
  elseif ($url[0] == 'modificar') {
    $controller->update($url[1]);
  }
}
?>