<?php

class AccionesModel {

  function __construct() {

  }
  private function connect() {
    return new PDO('mysql:host=localhost;'.'dbname=tabrokers;charset=utf8', 'root', '');
  }

  function getAcciones() {
    $db = $this->connect();

    $sentencia = $db->prepare( "select * from accion");
    $sentencia->execute();
    $acciones = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    return $acciones;
  }
}
?>
