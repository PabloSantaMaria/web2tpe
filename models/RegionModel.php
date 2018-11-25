<?php

require_once './models/BaseModel.php';

class RegionModel extends BaseModel {
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
    * inserta una región nueva
    */
    function insertRegion($region) {
        $sentencia = $this->db->prepare("INSERT INTO region(region) VALUES(?)");
        $sentencia->execute(array($region));
    }
    /**
     * borra una región por id
     */
    function deleteRegion($id_region) {
        $sentencia = $this->db->prepare("DELETE FROM region WHERE id_region=?");
        $sentencia->execute(array($id_region));
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