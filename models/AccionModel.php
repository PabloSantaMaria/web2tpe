<?php

require_once 'BaseModel.php';

class AccionModel extends BaseModel {
    /**
    * trae todas las acciones
    */
    function fetchAll() {
        $sentencia = $this->db->prepare("SELECT accion.*, pais.pais, region.region FROM accion, pais, region WHERE region.id_region = pais.id_region AND accion.id_pais=pais.id_pais ORDER BY region.region ASC");
        $sentencia->execute();
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
    /**
    * inserta una acción nueva y le asigna un país existente
    * el país ya pertenece a alguna región
    */
    function insertAccion($accion, $id_pais, $precio, $variacion, $volumen, $maximo, $minimo) {
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