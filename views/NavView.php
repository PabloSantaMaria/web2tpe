<?php
require_once "./libs/Smarty.class.php";

class NavView {
  private $smarty;
  private $baseURL;
  
  function __construct() {
    $this->smarty = new Smarty();
    $this->baseURL = '//'.$_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']).'/';
  }

  function home() {
      $this->smarty->assign('titulo', 'TAbrokers - Home');
      $this->smarty->assign('baseURL', $this->baseURL);
      $this->smarty->display('./templates/home.tpl');
  }
  function operar() {
      $this->smarty->assign('titulo', 'TAbrokers - Operaciones');
      $this->smarty->assign('baseURL', $this->baseURL);
      $this->smarty->display('./templates/operar.tpl');
  }
  function acerca() {
      $this->smarty->assign('titulo', 'TAbrokers - Acerca de nosotros');
      $this->smarty->assign('baseURL', $this->baseURL);
      $this->smarty->display('./templates/acerca.tpl');
  }
}
?>