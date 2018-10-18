<?php
require_once "./libs/Smarty.class.php";

class AdminView {
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
   * muestra template de página principal de admin
   */
  function adminHome($regiones, $paises, $mensaje) {
    $this->smarty->assign('title', 'Administrador');
    $this->smarty->assign('regiones', $regiones);
    $this->smarty->assign('paises', $paises);
    $this->smarty->assign('mensaje', $mensaje);
    $this->smarty->assign('baseURL', $this->baseURL);
    $this->smarty->display('./templates/admin.tpl');
  }
  /**
   * muestra template de página de controles de admin
   */
  function adminDisplay($regiones, $paises, $acciones, $mensaje) {
    $this->smarty->assign('title', 'TAbrokers - Administrador');
    $this->smarty->assign('regiones', $regiones);
    $this->smarty->assign('paises', $paises);
    $this->smarty->assign('acciones', $acciones);
    $this->smarty->assign('mensaje', $mensaje);
    $this->smarty->assign('baseURL', $this->baseURL);
    $this->smarty->display('./templates/adminDisplay.tpl');
  }
  /**
   * muestra template de form editar acción
   */
  function displayUpdateForm($accion, $paises) {
    $this->smarty->assign('title', 'TAbrokers - Editar');
    $this->smarty->assign('accion', $accion);
    $this->smarty->assign('paises', $paises);
    $this->smarty->assign('baseURL', $this->baseURL);
    $this->smarty->display('./templates/editar.tpl');
  }
}
?>