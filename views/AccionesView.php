<?php
require_once "./libs/Smarty.class.php";

class AccionesView {
  private $smarty;
  
  function __construct() {
    $this->smarty = new Smarty();
  }

  function home($acciones) {
    
      $this->smarty->assign('titulo', 'TAbrokers');
      $this->smarty->display('./templates/index.tpl');

    //   foreach ($acciones as $accion) {
    //   echo '<li>' . $accion['nombre'] . ': ' . $accion['precio'] . '<a href="borrar/' . $accion['id_accion'] . '">BORRAR</a> | <a href="completada/' . $accion['id_accion'] . '">COMPLETADA</a></li>';
    // }
  }
  
  function mostrarAcciones($acciones) {
    
      $this->smarty->assign('titulo', 'TAbrokers - Cotizaciones');
      $this->smarty->display('./templates/cotizaciones.tpl');

    //   foreach ($acciones as $accion) {
    //   echo '<li>' . $accion['nombre'] . ': ' . $accion['precio'] . '<a href="borrar/' . $accion['id_accion'] . '">BORRAR</a> | <a href="completada/' . $accion['id_accion'] . '">COMPLETADA</a></li>';
    // }
  }
  
  function mostrarAccion($accion)  {
    echo '[' . $accion['id_accion'] . ', ' . $accion['nombre'] . ', ' . $accion['precio'] . ']';
  }
}
?>