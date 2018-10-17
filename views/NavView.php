<?php
require_once "./libs/Smarty.class.php";

class NavView {
  private $smarty;
  private $baseURL;
  
  function __construct() {
    $this->smarty = new Smarty();
    $this->baseURL = '//'.$_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']).'/';
  }

  function home($title, $regiones) {
    $this->smarty->assign('title', $title);
    $this->smarty->assign('regiones', $regiones);
    $this->smarty->assign('baseURL', $this->baseURL);
    $this->smarty->display('./templates/home.tpl');
  }
  function displayCotizaciones($title, $acciones, $regiones) {
    $this->smarty->assign('title', $title);
    $this->smarty->assign('acciones', $acciones);
    $this->smarty->assign('regiones', $regiones);
    $this->smarty->assign('baseURL', $this->baseURL);
    $this->smarty->display('./templates/cotizaciones.tpl');
  }
  function acerca($title, $regiones) {
    $this->smarty->assign('title', $title);
    $this->smarty->assign('regiones', $regiones);
    $this->smarty->assign('baseURL', $this->baseURL);
    $this->smarty->display('./templates/acerca.tpl');
  }
  function displayLogin($title, $regiones) {
    $this->smarty->assign('title', $title);
    $this->smarty->assign('regiones', $regiones);
    $this->smarty->assign('baseURL', $this->baseURL);
    $this->smarty->display('./templates/login.tpl');
  }
}
?>