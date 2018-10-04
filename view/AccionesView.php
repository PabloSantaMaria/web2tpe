<?php

class AccionesView {

  function __construct() {

  }

  function mostrar($acciones) {
    foreach ($acciones as $accion) {
        echo $accion['nombre'] . ', ' . $accion['precio'];
    }
  }
}
?>
