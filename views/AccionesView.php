<?php
require_once "./libs/Smarty.class.php";

class AccionesView {
  private $smarty;
  private $baseURL;
  
  function __construct() {
    $this->smarty = new Smarty();
    $this->baseURL = '//'.$_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']).'/';
  }

  function mostrarAcciones($acciones) {
      $this->smarty->assign('titulo', 'TAbrokers - Cotizaciones');
      $this->smarty->assign('acciones', $acciones);
      $this->smarty->assign('baseURL', $this->baseURL);
      $this->smarty->display('./templates/cotizaciones.tpl');
  }
  
  
  
  function mostrarAccion($accion)  {
    
  }
}
?>