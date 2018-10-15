<?php
require_once "./libs/Smarty.class.php";

class LoginView {
  private $smarty;
  private $baseURL;
  
  function __construct() {
    $this->smarty = new Smarty();
    $this->baseURL = '//'.$_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']).'/';
  }

  function displayLogin() {
      $this->smarty->assign('titulo', 'TAbrokers - Login');
      $this->smarty->assign('baseURL', $this->baseURL);
      $this->smarty->display('./templates/login.tpl');
  }
}
?>