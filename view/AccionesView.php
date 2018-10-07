<?php

class AccionesView {

  function __construct() {

  }

  function mostrarAcciones($acciones) {
    foreach ($acciones as $accion) {
      echo '<li>' . $accion['nombre'] . ': ' . $accion['precio'] . '<a href="borrar/' . $accion['id_accion'] . '">BORRAR</a> | <a href="completada/' . $accion['id_accion'] . '">COMPLETADA</a></li>';
      //echo '[' . $accion['id_accion'] . ', ' . $accion['nombre'] . ', ' . $accion['precio'] . ']';
    }
  }

  function mostrarAccion($accion)  {
    echo '[' . $accion['id_accion'] . ', ' . $accion['nombre'] . ', ' . $accion['precio'] . ']';
  }
}
?>