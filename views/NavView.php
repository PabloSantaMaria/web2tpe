<?php
require_once "BaseView.php";

class NavView extends BaseView {
  
  function __construct() {
    parent::__construct();
  }
  /**
   * muestra template de página principal
   */
  function home($title, $regiones) {
    $this->smarty->assign('title', $title);
    $this->smarty->assign('regiones', $regiones);
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
    $this->smarty->display('./templates/cotizaciones.tpl');
  }
  /**
   * muestra template acerca de nosotros
   */
  function acerca($title, $regiones) {
    $this->smarty->assign('title', $title);
    $this->smarty->assign('regiones', $regiones);
    $this->smarty->display('./templates/acerca.tpl');
  }
  /**
   * muestra template detalle de acción
   */
  function detalleAccion($title, $regiones, $accion) {
    $this->smarty->assign('title', $title);
    $this->smarty->assign('regiones', $regiones);
    $this->smarty->assign('accion', $accion);
    $this->smarty->display('./templates/detalleAccion.tpl');
  }
  /**
   * muestra template de página de login
   */
  function displayLogin($title, $regiones, $mensaje = '') {
    $this->smarty->assign('title', $title);
    $this->smarty->assign('regiones', $regiones);
    $this->smarty->assign('mensaje', $mensaje);
    $this->smarty->display('./templates/login.tpl');
  }
  /**
   * muestra template de página de sign in
   */
  function displaySignin($title, $regiones, $mensaje = '') {
    $this->smarty->assign('title', $title);
    $this->smarty->assign('regiones', $regiones);
    $this->smarty->assign('mensaje', $mensaje);
    $this->smarty->display('./templates/signIn.tpl');
  }
}