<?php
require_once "./libs/Smarty.class.php";

class NavView {
  private $smarty;
  
  function __construct() {
    $this->smarty = new Smarty();
  }

  function home() {
      $this->smarty->assign('titulo', 'TAbrokers');
      $this->smarty->display('./templates/home.tpl');
  }
}
?>