<?php
require_once "./libs/Smarty.class.php";

class ComentariosView {
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

  function verComentarios($title, $acciones, $regiones, $user, $logueado, $isAdmin) {
    $this->smarty->assign('title', $title);
    $this->smarty->assign('acciones', $acciones);
    $this->smarty->assign('regiones', $regiones);
    $this->smarty->assign('user', $user);
    $this->smarty->assign('logueado', $logueado);
    $this->smarty->assign('isAdmin', $isAdmin);
    $this->smarty->assign('baseURL', $this->baseURL);
    $this->smarty->display('./templates/comentarios.tpl');
  }
}