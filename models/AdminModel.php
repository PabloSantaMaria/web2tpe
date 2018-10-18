<?php

class AdminModel {
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
  * trae todas las acciones de una región
  */
  function fetchRegion($region) {
    $sentencia = $this->db->prepare("SELECT accion.*, pais.pais FROM accion, pais, region WHERE region.id_region = pais.id_region AND region.region=? AND accion.id_pais=pais.id_pais");
    $sentencia->execute(array($region));
    $acciones = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    return $acciones;
  }
  /**
  * trae todas las acciones de un país
  */
  function fetchPais($pais) {
    $sentencia = $this->db->prepare("SELECT accion.*, pais.pais FROM accion, pais WHERE pais.pais=? AND accion.id_pais=pais.id_pais");
    $sentencia->execute(array($pais));
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
  * trae el nombre de todos los países
  */
  function fetchPaises() {
    $sentencia = $this->db->prepare("SELECT pais.pais FROM pais ORDER BY pais ASC");
    $sentencia->execute(array());
    $paises = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    return $paises;
  }
  /**
  * trae una acción por id con el respectivo nombre del país al que pertenece
  */
  function fetchAccion($id_accion) {
    $sentencia = $this->db->prepare("SELECT accion.*, pais.pais FROM accion, pais WHERE id_accion=? AND accion.id_pais = pais.id_pais");
    $sentencia->execute(array($id_accion));
    $accion = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    return $accion;
  }
  /**
  * trae el nombre de la región a la que pertenece un país
  */
  function fetchRegionDePais($pais) {
    $sentencia = $this->db->prepare("SELECT pais.pais, region.region FROM pais, region WHERE pais.pais=? AND pais.id_region=region.id_region");
    $sentencia->execute(array($pais));
    $region = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    return $region;
  }
  /**
  * trae los datos de un usuario
  */
  function fetchUser($user) {
    $sentencia = $this->db->prepare("SELECT * FROM usuario WHERE usuario=?");
    $sentencia->execute(array($user));
    $dbUser = $sentencia->fetch(PDO::FETCH_ASSOC);
    return $dbUser;
  }
  /**
  * inserta una región nueva
  */
  function insertRegion($region) {
    $sentencia = $this->db->prepare("INSERT INTO region(region) VALUES(?)");
    $sentencia->execute(array($region));
  }
  /**
  * inserta un país nuevo y le asigna una región existente
  */
  function insertPais($pais, $id_region) {
    $sentencia = $this->db->prepare("INSERT INTO pais(pais, id_region) VALUES(?,?)");
    $sentencia->execute(array($pais, $id_region));
  }
  /**
  * inserta una acción nueva y le asigna un país existente
  * el país ya pertenece a alguna región
  */
  function insertAccion($id_pais, $accion, $precio, $variacion, $volumen, $maximo, $minimo) {
      $sentencia = $this->db->prepare("INSERT INTO accion(accion, id_pais, precio, variacion, volumen, maximo, minimo) VALUES(?,?,?,?,?,?,?)");
      $sentencia->execute(array($accion, $id_pais, $precio, $variacion, $volumen, $maximo, $minimo));
  }
  /**
  * actualiza una acción por id
  * se puede asignar un nuevo país, si el país ya existe
  */
  function updateAccion($id_accion, $accion, $id_pais, $precio, $variacion, $volumen, $maximo, $minimo) {
    $sentencia = $this->db->prepare("UPDATE accion SET accion = ?, id_pais = ?, precio = ?, variacion = ?, volumen = ?, maximo = ?, minimo = ? WHERE id_accion = ?");
    $sentencia->execute(array($accion, $id_pais, $precio, $variacion, $volumen, $maximo, $minimo, $id_accion));
  }
  /**
   * borra una acción por id
   */
  function deleteAccion($id_accion) {
    $sentencia = $this->db->prepare("DELETE FROM accion WHERE id_accion=?");
    $sentencia->execute(array($id_accion));
  }
  /**
  * inserta un usuario nuevo
  * la contraseña viene encriptada
  */
  function insertUsuario($user, $hash) {
    $sentencia = $this->db->prepare("INSERT INTO usuario(usuario, pass) VALUES(?,?)");
    $sentencia->execute(array($user, $hash));
  }
  /**
   * borra un usuario existente
   */
  function deleteUser($user) {
    $sentencia = $this->db->prepare("DELETE FROM usuario WHERE usuario=?");
    $sentencia->execute(array($user));
  }
  /**
   * devuelve boolean según la existencia de un dato en una tabla
   */
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
  /**
   * devuelve la id de un dato en una tabla
   */
  function getID($tabla, $item) {
    $campoID = "id_" . $tabla;
    $sentencia = $this->db->prepare("SELECT $tabla.$campoID FROM $tabla WHERE $tabla.$tabla = '$item'");
    $sentencia->execute(array());
    $id_item = $sentencia->fetch(PDO::FETCH_ASSOC);
    return $id_item[$campoID];
  }
}
?>