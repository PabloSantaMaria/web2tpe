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
    $sentencia = $this->db->prepare("SELECT accion.*, pais.pais FROM accion, pais, region WHERE region.id_region = pais.id_region AND region.region=? AND accion.id_pais=pais.id_pais");
    $sentencia->execute(array($region));
    $acciones = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    return $acciones;
  }

  //trae todas las de un pais:
  //SELECT accion.*, pais.pais FROM accion INNER JOIN pais ON accion.id_pais = pais.id_pais AND pais.pais=?
  
  private function existePais($pais) {
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

  private function traerID($tabla, $item) {
    $campoID = "id_" . $tabla;
    $sentencia = $this->db->prepare("SELECT $tabla.$campoID FROM $tabla WHERE $tabla.$tabla = '$item'");
    $sentencia->execute(array());
    $id_item = $sentencia->fetch(PDO::FETCH_ASSOC);
    return $id_item[$campoID];
  }

  function test() {
    $existe = $this->existePais("dsafdsfs");
    var_dump($existe);
  }
  
  function insertAccion($region, $pais, $accion, $precio, $variacion, $volumen, $maximo, $minimo) {
    if ($this->existePais($pais)) {
      $id_pais = $this->traerID("pais", $pais);
      $sentencia = $this->db->prepare("INSERT INTO accion(accion, id_pais, precio, variacion, volumen, maximo, minimo) VALUES(?,?,?,?,?,?,?)");
      $sentencia->execute(array($accion, $id_pais, $precio, $variacion, $volumen, $maximo, $minimo));
    }


    // foreach ($paises as $item) {
    //   if ($item['pais'] == $pais) {
    //     //traer id de pais
    //     //existePais()
    //     $sentencia = $this->db->prepare("SELECT pais.id_pais FROM pais WHERE pais.pais=?");
    //     $sentencia->execute(array($pais));
    //     $id_pais = $sentencia->fetch(PDO::FETCH_ASSOC);
    //     //insertar accion con id de pais existente
    //     $sentencia = $this->db->prepare("INSERT INTO accion(accion, id_pais, precio, variacion, volumen, maximo, minimo) VALUES(?,?,?,?,?,?,?)");
    //     $sentencia->execute(array($accion, $id_pais['id_pais'], $precio, $variacion, $volumen, $maximo, $minimo));
    //   }
    //   else {
    //     //traer id de region
    //     $sentencia = $this->db->prepare("SELECT region.id_region FROM region WHERE region.region=?");
    //     $sentencia->execute(array($region));
    //     $id_region = $sentencia->fetch(PDO::FETCH_ASSOC);
    //     //agregar pais en tabla pais
    //     $sentencia = $this->db->prepare("INSERT INTO pais(pais, id_region) VALUES(?,?)");
    //     $sentencia->execute(array($pais, $id_region['id_region']));
    //     //traer id de pais nuevo
    //     $sentencia = $this->db->prepare("SELECT pais.id_pais FROM pais WHERE pais.pais=?");
    //     $sentencia->execute(array($pais));
    //     $id_pais = $sentencia->fetch(PDO::FETCH_ASSOC);
    //     //insertar accion con pais nuevo
    //     $sentencia = $this->db->prepare("INSERT INTO accion(accion, id_pais, precio, variacion, volumen, maximo, minimo) VALUES(?,?,?,?,?,?,?)");
    //     $sentencia->execute(array($accion, $id_pais['id_pais'], $precio, $variacion, $volumen, $maximo, $minimo));
    //   }
    // }

    //traer id de pais
    // $sentencia = $this->db->prepare("SELECT pais.id_pais FROM pais WHERE pais.pais=?");
    // $sentencia->execute(array($pais));
    // $id_pais = $sentencia->fetch(PDO::FETCH_ASSOC);
    //traer id de region



    // $sentencia = $this->db->prepare("INSERT INTO pais(pais, region)");
    // $sentencia = $this->db->prepare("INSERT INTO accion(accion, precio, variacion, volumen, maximo, minimo) VALUES(?,?,?,?,?,?)");
    // $sentencia->execute(array($accion, $precio, $variacion, $volumen, $maximo, $minimo));
  }
  
  function updateAccion($id_accion, $accion, $precio, $variacion, $volumen, $maximo, $minimo) {
    $sentencia = $this->db->prepare("UPDATE accion SET accion = ?, precio = ?, variacion = ?, volumen = ?, maximo = ?, minimo = ? WHERE id_accion = ?");
    $sentencia->execute(array($accion, $precio, $variacion, $volumen, $maximo, $minimo, $id_accion));
  }

  function deleteAccion($id_accion) {
    $sentencia = $this->db->prepare("DELETE FROM accion WHERE id_accion=?");
    $sentencia->execute(array($id_accion));
  }
}
?>