<?php

class AccionesModel {
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

  function fetchRegion($region) {
    $sentencia = $this->db->prepare("SELECT accion.*, pais.pais FROM accion, pais, region WHERE region.id_region = pais.id_region AND region.region=? AND accion.id_pais=pais.id_pais");
    $sentencia->execute(array($region));
    $acciones = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    return $acciones;
  }

  function fetchAccion($id_accion) {
    $sentencia = $this->db->prepare("SELECT accion.*, pais.pais FROM accion, pais WHERE id_accion=? AND accion.id_pais = pais.id_pais");
    $sentencia->execute(array($id_accion));
    $accion = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    return $accion;
  }

  function updateAccion($id_accion, $accion, $precio, $variacion, $volumen, $maximo, $minimo) {
    $sentencia = $this->db->prepare("UPDATE accion SET accion = ?, precio = ?, variacion = ?, volumen = ?, maximo = ?, minimo = ? WHERE id_accion = ?");
    $sentencia->execute(array($accion, $precio, $variacion, $volumen, $maximo, $minimo, $id_accion));
  }
  
  function existePais($pais) {
    $sentencia = $this->db->prepare("SELECT pais.pais FROM pais");
    $sentencia->execute(array());
    $paises = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    $contiene = false;
    foreach ($paises as $item) {
      if ($item['pais'] == $pais) {
        $contiene = true;
      }
    }
    return $contiene;
  }

  function getID($tabla, $item) {
    $campoID = "id_" . $tabla;
    $sentencia = $this->db->prepare("SELECT $tabla.$campoID FROM $tabla WHERE $tabla.$tabla = '$item'");
    $sentencia->execute(array());
    $id_item = $sentencia->fetch(PDO::FETCH_ASSOC);
    return $id_item[$campoID];
  }
  
  function insertPais($pais, $id_region) {
    $sentencia = $this->db->prepare("INSERT INTO pais(pais, id_region) VALUES(?,?)");
    $sentencia->execute(array($pais, $id_region));
  }
  
  function insertAccion($id_pais, $accion, $precio, $variacion, $volumen, $maximo, $minimo) {
      $sentencia = $this->db->prepare("INSERT INTO accion(accion, id_pais, precio, variacion, volumen, maximo, minimo) VALUES(?,?,?,?,?,?,?)");
      $sentencia->execute(array($accion, $id_pais, $precio, $variacion, $volumen, $maximo, $minimo));
  }
  
  function deleteAccion($id_accion) {
    $sentencia = $this->db->prepare("DELETE FROM accion WHERE id_accion=?");
    $sentencia->execute(array($id_accion));
  }
}
?>