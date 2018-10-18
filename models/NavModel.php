<?php

class NavModel {
  private $db;

  /**
   * inicializa db y crea objeto PDO
   */
  function __construct() {
    $this->db = $this->connect();
  }
  private function connect() {
    return new PDO('mysql:host=localhost;'.'dbname=tabrokers;charset=utf8', 'root', '');
  }
  /**
   * trae todas las acciones
   */
  function fetchAll() {
    $sentencia = $this->db->prepare("SELECT accion.*, pais.pais FROM accion INNER JOIN pais ON accion.id_pais = pais.id_pais ORDER BY pais.pais ASC");
    $sentencia->execute();
    $acciones = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    return $acciones;
  }
  /**
  * trae el nombre de todas las regiones
  */
  function fetchRegiones() {
    $sentencia = $this->db->prepare("SELECT region.region FROM region ORDER BY region ASC");
    $sentencia->execute(array());
    $regiones = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    return $regiones;
  }
  /**
   * trae todas las acciones de una región
   */
  function fetchRegion($region) {
    $sentencia = $this->db->prepare("SELECT accion.*, pais.pais, region.region FROM accion, pais, region WHERE region.id_region = pais.id_region AND region.region=? AND accion.id_pais=pais.id_pais");
    $sentencia->execute(array($region));
    $acciones = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    return $acciones;
  }
  /**
  * trae una acción por id con el respectivo nombre del país al que pertenece
  */
  function fetchAccion($id_accion) {
    $sentencia = $this->db->prepare("SELECT accion.*, pais.pais, region.region FROM accion, pais, region WHERE id_accion=? AND accion.id_pais = pais.id_pais AND pais.id_region=region.id_region");
    $sentencia->execute(array($id_accion));
    $accion = $sentencia->fetch(PDO::FETCH_ASSOC);
    return $accion;
  }
}
?>