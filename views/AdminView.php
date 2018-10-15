<?php
require_once "./libs/Smarty.class.php";

class AdminView {
  private $smarty;
  private $baseURL;
  
  function __construct() {
    $this->smarty = new Smarty();
    $this->baseURL = '//'.$_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']).'/';
  }

  function adminHome() {
      $this->smarty->assign('titulo', 'TAbrokers - Administrador');
      $this->smarty->assign('baseURL', $this->baseURL);
      $this->smarty->display('./templates/admin.tpl');
  }
}
?>