<?php
require_once "./libs/Smarty.class.php";

class AccionesView {
  
  function __construct() {
    
  }
  
  function mostrarAcciones($acciones) {
    
      
      $smarty = new Smarty();
      $smarty->assign('titulo', 'TAbrokers');
      //$smarty->assign('base', '<base href="//".$_SERVER["SERVER_NAME"].dirname($_SERVER["PHP_SELF"])."/"; target="_blank">');
      $smarty->display('./templates/index.tpl');

    //   foreach ($acciones as $accion) {
    //   echo '<li>' . $accion['nombre'] . ': ' . $accion['precio'] . '<a href="borrar/' . $accion['id_accion'] . '">BORRAR</a> | <a href="completada/' . $accion['id_accion'] . '">COMPLETADA</a></li>';
    // }
  }
  
  function mostrarAccion($accion)  {
    echo '[' . $accion['id_accion'] . ', ' . $accion['nombre'] . ', ' . $accion['precio'] . ']';
  }
}
?>