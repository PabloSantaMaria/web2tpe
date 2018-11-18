<?php

require_once './models/BaseModel.php';

class PaisModel extends BaseModel {
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
    * trae todas las acciones de un país
    */
    function fetchPais($pais) {
        $sentencia = $this->db->prepare("SELECT accion.*, pais.pais FROM accion, pais WHERE pais.pais=? AND accion.id_pais=pais.id_pais");
        $sentencia->execute(array($pais));
        $acciones = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $acciones;
    }
    
    function fetchPaisesPorRegion($region) {
        $sentencia = $this->db->prepare("SELECT pais.*, region.region FROM pais, region WHERE region.region=? AND pais.id_region = region.id_region");
        $sentencia->execute(array($region));
        $paises = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $paises;
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
    * inserta un país nuevo y le asigna una región existente
    */
    function insertPais($pais, $id_region) {
        $sentencia = $this->db->prepare("INSERT INTO pais(pais, id_region) VALUES(?,?)");
        $sentencia->execute(array($pais, $id_region));
    }
    
    function deletePais($id_pais) {
        $sentencia = $this->db->prepare("DELETE FROM pais WHERE id_pais=?");
        $sentencia->execute(array($id_pais));
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