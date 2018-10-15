<?php
require_once "./libs/Smarty.class.php";

class AdminView {
  private $smarty;
  private $baseURL;
  
  function __construct() {
    $this->smarty = new Smarty();
    $this->baseURL = '//'.$_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']).'/';
  }

  function adminHome($regiones, $paises) {
      $this->smarty->assign('titulo', 'TAbrokers - Administrador');
      $this->smarty->assign('regiones', $regiones);
      $this->smarty->assign('paises', $paises);
      $this->smarty->assign('baseURL', $this->baseURL);
      $this->smarty->display('./templates/admin.tpl');
  }
  function adminDisplay($regiones, $paises, $acciones) {
      $this->smarty->assign('titulo', 'TAbrokers - Administrador');
      $this->smarty->assign('regiones', $regiones);
      $this->smarty->assign('paises', $paises);
      $this->smarty->assign('acciones', $acciones);
      $this->smarty->assign('baseURL', $this->baseURL);
      $this->smarty->display('./templates/adminDisplay.tpl');
  }
}
?>