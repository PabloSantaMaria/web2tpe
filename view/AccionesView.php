<?php

class AccionesView {

  function __construct() {

  }

  function mostrar($acciones) {
    foreach ($acciones as $accion) {
        echo '[' . $accion['id_accion'] . ', ' . $accion['nombre'] . ', ' . $accion['precio'] . ']';
    }
  }
}
?>
