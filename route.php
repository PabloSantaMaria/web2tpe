<?php
require_once "controller/AccionesController.php";

$controller = new AccionesController();
$url = explode('/', $_GET['action']);

if ($url[0] == '') {
  $controller->home();
}
else {
  if ($url[0] == 'agregar') {
    $controller->insert();
  }
}

?>
