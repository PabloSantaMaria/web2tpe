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

  function getAccion($id_accion) {
    $sentencia = $this->db->prepare("SELECT accion.*, pais.pais FROM accion, pais WHERE id_accion=? AND accion.id_pais = pais.id_pais");
    $sentencia->execute(array($id_accion));
    $accion = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    return $accion;
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

  function updateAccion($id_accion, $accion, $precio, $variacion, $volumen, $maximo, $minimo) {
    $sentencia = $this->db->prepare("UPDATE accion SET accion = ?, precio = ?, variacion = ?, volumen = ?, maximo = ?, minimo = ? WHERE id_accion = ?");
    $sentencia->execute(array($accion, $precio, $variacion, $volumen, $maximo, $minimo, $id_accion));
  }

  function deleteAccion($id_accion) {
    $sentencia = $this->db->prepare("DELETE FROM accion WHERE id_accion=?");
    $sentencia->execute(array($id_accion));
  }

  

  //estoy probando solo con 2 campos
  function insertAccion($nombre, $precio) {
    $sentencia = $this->db->prepare("INSERT INTO accion(nombre, precio) VALUES(?, ?)");
    $sentencia->execute(array($nombre, $precio));
  }

  

  
}
?>