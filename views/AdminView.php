<?php
require_once "BaseView.php";

class AdminView extends BaseView {
  
  function __construct() {
    parent::__construct();
  }
  /**
   * muestra template de página principal de admin
   */
  function adminHome($regiones, $paises, $mensaje) {
    $this->smarty->assign('title', 'Administrador');
    $this->smarty->assign('regiones', $regiones);
    $this->smarty->assign('paises', $paises);
    $this->smarty->assign('mensaje', $mensaje);
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
    $this->smarty->display('./templates/adminDisplay.tpl');
  }
  /**
   * muestra template de form editar acción
   */
  function displayUpdateForm($accion, $paises, $regiones) {
    $this->smarty->assign('title', 'TAbrokers - Editar');
    $this->smarty->assign('regiones', $regiones);
    $this->smarty->assign('accion', $accion);
    $this->smarty->assign('paises', $paises);
    $this->smarty->display('./templates/editar.tpl');
  }
}
?>