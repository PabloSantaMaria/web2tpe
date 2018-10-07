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
    $sentencia = $this->db->prepare( "SELECT * FROM accion");
    $sentencia->execute();
    $acciones = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    return $acciones;
  }

  function getAccion($id_accion) {
    $sentencia = $this->db->prepare("SELECT * FROM `accion` WHERE `id_accion`=?");
    $sentencia->execute(array($id_accion));
    $accion = $sentencia->fetch(PDO::FETCH_ASSOC);
    return $accion;
  }

  //estoy probando solo con 2 campos
  function insertAccion($nombre, $precio) {
    $sentencia = $this->db->prepare("INSERT INTO accion(nombre, precio) VALUES(?, ?)");
    $sentencia->execute(array($nombre, $precio));
  }

  function deleteAccion($id_accion) {
    $sentencia = $this->db->prepare("DELETE FROM accion WHERE id_accion=?");
    $sentencia->execute(array($id_accion));
  }

  function updateAccion($id_accion) {
    //$sentencia = $this->db->prepare("UPDATE accion SET nombre=? WHERE id_accion=?");
    $sentencia->execute(array($id_accion));
  }
}
?>