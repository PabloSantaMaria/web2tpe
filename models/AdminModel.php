<?php

class AdminModel {
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

  function fetchPais($pais) {
    $sentencia = $this->db->prepare("SELECT accion.*, pais.pais FROM accion, pais WHERE pais.pais=? AND accion.id_pais=pais.id_pais");
    $sentencia->execute(array($pais));
    $acciones = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    return $acciones;
  }

  function fetchRegiones() {
    $sentencia = $this->db->prepare("SELECT region.region FROM region ORDER BY region ASC");
    $sentencia->execute(array());
    $regiones = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    return $regiones;
  }

  function fetchPaises() {
    $sentencia = $this->db->prepare("SELECT pais.pais FROM pais ORDER BY pais ASC");
    $sentencia->execute(array());
    $paises = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    return $paises;
  }

  function fetchAccion($id_accion) {
    $sentencia = $this->db->prepare("SELECT accion.*, pais.pais FROM accion, pais WHERE id_accion=? AND accion.id_pais = pais.id_pais");
    $sentencia->execute(array($id_accion));
    $accion = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    return $accion;
  }

  function fetchUser($user) {
    $sentencia = $this->db->prepare("SELECT * FROM usuario WHERE usuario=?");
    $sentencia->execute(array($user));
    $dbUser = $sentencia->fetch(PDO::FETCH_ASSOC);
    return $dbUser;
  }

  function insertRegion($region) {
    $sentencia = $this->db->prepare("INSERT INTO region(region) VALUES(?)");
    $sentencia->execute(array($region));
  }

  function insertPais($pais, $id_region) {
    $sentencia = $this->db->prepare("INSERT INTO pais(pais, id_region) VALUES(?,?)");
    $sentencia->execute(array($pais, $id_region));
  }

  function insertAccion($id_pais, $accion, $precio, $variacion, $volumen, $maximo, $minimo) {
      $sentencia = $this->db->prepare("INSERT INTO accion(accion, id_pais, precio, variacion, volumen, maximo, minimo) VALUES(?,?,?,?,?,?,?)");
      $sentencia->execute(array($accion, $id_pais, $precio, $variacion, $volumen, $maximo, $minimo));
  }

  function insertUsuario($user, $hash) {
    $sentencia = $this->db->prepare("INSERT INTO usuario(usuario, pass) VALUES(?,?)");
    $sentencia->execute(array($user, $hash));
  }

  function updateAccion($id_accion, $accion, $id_pais, $precio, $variacion, $volumen, $maximo, $minimo) {
    $sentencia = $this->db->prepare("UPDATE accion SET accion = ?, id_pais = ?, precio = ?, variacion = ?, volumen = ?, maximo = ?, minimo = ? WHERE id_accion = ?");
    $sentencia->execute(array($accion, $id_pais, $precio, $variacion, $volumen, $maximo, $minimo, $id_accion));
  }

  function deleteUser($user) {
    $sentencia = $this->db->prepare("DELETE FROM usuario WHERE usuario=?");
    $sentencia->execute(array($user));
  }

  function deleteAccion($id_accion) {
    $sentencia = $this->db->prepare("DELETE FROM accion WHERE id_accion=?");
    $sentencia->execute(array($id_accion));
  }

  function existeItem($tabla, $item) {
    $sentencia = $this->db->prepare("SELECT $tabla.$tabla FROM $tabla");
    $sentencia->execute(array());
    $valores = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    $contiene = false;
    foreach ($valores as $valor) {
      if ($valor[$tabla] == $item) {
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
}
?>