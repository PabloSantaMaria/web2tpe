<?php

class AccionesModel {
  private $db;

  function __construct() {
    $this->db = $this->connect();
  }
  private function connect() {
    return new PDO('mysql:host=localhost;'.'dbname=tabrokers;charset=utf8', 'root', '');
  }

  function getAcciones() {
    $sentencia = $this->db->prepare( "select * from accion");
    $sentencia->execute();
    $acciones = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    return $acciones;
  }

  //estoy probando solo con 2 campos
  function insertAccion($nombre, $precio) {
    $sentencia = $this->db->prepare("INSERT INTO accion(nombre, precio) VALUES(?, ?)");
    $sentencia->execute(array($nombre, $precio));
  }
}
?>
