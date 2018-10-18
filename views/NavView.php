<?php
require_once "./libs/Smarty.class.php";

class NavView {
  private $smarty;
  private $baseURL;
  
  /**
   * inicializa template engine Smarty
   * asigna base url para insertar en head de htmls
   */
  function __construct() {
    $this->smarty = new Smarty();
    $this->baseURL = '//'.$_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']).'/';
  }
  /**
   * muestra template de página principal
   */
  function home($title, $regiones) {
    $this->smarty->assign('title', $title);
    $this->smarty->assign('regiones', $regiones);
    $this->smarty->assign('baseURL', $this->baseURL);
    $this->smarty->display('./templates/home.tpl');
  }
  /**
   * muestra template de página de cotizaciones de visitante
   */
  function displayCotizaciones($title, $acciones, $regiones, $region) {
    $this->smarty->assign('title', $title);
    $this->smarty->assign('acciones', $acciones);
    $this->smarty->assign('regiones', $regiones);
    $this->smarty->assign('region', $region);
    $this->smarty->assign('baseURL', $this->baseURL);
    $this->smarty->display('./templates/cotizaciones.tpl');
  }
  /**
   * muestra template acerca de nosotros
   */
  function acerca($title, $regiones) {
    $this->smarty->assign('title', $title);
    $this->smarty->assign('regiones', $regiones);
    $this->smarty->assign('baseURL', $this->baseURL);
    $this->smarty->display('./templates/acerca.tpl');
  }
  /**
   * muestra template de página de login
   */
  function displayLogin($title, $regiones, $mensaje = '') {
    $this->smarty->assign('title', $title);
    $this->smarty->assign('regiones', $regiones);
    $this->smarty->assign('mensaje', $mensaje);
    $this->smarty->assign('baseURL', $this->baseURL);
    $this->smarty->display('./templates/login.tpl');
  }
}
?>