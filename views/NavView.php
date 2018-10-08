<?php
require_once "./libs/Smarty.class.php";

class NavView {
  private $smarty;
  
  function __construct() {
    $this->smarty = new Smarty();
  }

  function home() {
      $this->smarty->assign('titulo', 'TAbrokers - Home');
      $this->smarty->display('./templates/home.tpl');
  }
  function operar() {
      $this->smarty->assign('titulo', 'TAbrokers - Operaciones');
      $this->smarty->display('./templates/operar.tpl');
  }
  function acerca() {
      $this->smarty->assign('titulo', 'TAbrokers - Acerca de nosotros');
      $this->smarty->display('./templates/acerca.tpl');
  }
}
?>