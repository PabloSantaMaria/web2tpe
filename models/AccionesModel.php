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
    $sentencia = $this->db->prepare("SELECT accion.*, pais.pais FROM accion INNER JOIN pais ON accion.id_pais = pais.id_pais ORDER BY pais.pais ASC");
    $sentencia->execute();
    $acciones = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    return $acciones;
  }

  function getRegion($region) {

    //SELECT accion.*, pais.pais FROM accion INNER JOIN pais ON accion.id_pais = pais.id_pais AND pais.pais=?

    //SELECT accion.*, pais.pais FROM accion, pais, region WHERE region.id_region = pais.id_region AND region.id_region=1 AND accion.id_pais=pais.id_pais;

    // $sentencia = $this->db->prepare("SELECT `pais`.`id_pais` FROM `pais` WHERE `pais`.`nombre`=?");
    // $sentencia->execute(array($region));
    // $id_pais = $sentencia->fetch(PDO::FETCH_ASSOC);
    
    $sentencia = $this->db->prepare("SELECT accion.*, pais.pais FROM accion, pais, region WHERE region.id_region = pais.id_region AND region.region=? AND accion.id_pais=pais.id_pais");
    $sentencia->execute(array($region));
    $acciones = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    return $acciones;
  }

  function deleteAccion($id_accion) {
    $sentencia = $this->db->prepare("DELETE FROM accion WHERE id_accion=?");
    $sentencia->execute(array($id_accion));
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

  

  function updateAccion($id_accion) {
    //$sentencia = $this->db->prepare("UPDATE accion SET nombre=? WHERE id_accion=?");
    $sentencia->execute(array($id_accion));
  }
}
?>