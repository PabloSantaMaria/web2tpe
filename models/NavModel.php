<?php

class NavModel {
  private $db;

  function __construct() {
    $this->db = $this->connect();
  }
  private function connect() {
    return new PDO('mysql:host=localhost;'.'dbname=tabrokers;charset=utf8', 'root', '');
  }

  function fetchAll() {
    $sentencia = $this->db->prepare("SELECT accion.*, pais.pais FROM accion INNER JOIN pais ON accion.id_pais = pais.id_pais ORDER BY pais.pais ASC");
    $sentencia->execute();
    $acciones = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    return $acciones;
  }
  
  function fetchRegiones() {
    $sentencia = $this->db->prepare("SELECT region.region FROM region ORDER BY region ASC");
    $sentencia->execute(array());
    $regiones = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    return $regiones;
  }
  
  function fetchRegion($region) {
    $sentencia = $this->db->prepare("SELECT accion.*, pais.pais FROM accion, pais, region WHERE region.id_region = pais.id_region AND region.region=? AND accion.id_pais=pais.id_pais");
    $sentencia->execute(array($region));
    $acciones = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    return $acciones;
  }
}
?>