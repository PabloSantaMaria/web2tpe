<?php
require_once "BaseView.php";

class ComentariosView extends BaseView {
  
  function __construct() {
    parent::__construct();
  }

  function verComentarios($title, $acciones, $regiones, $user, $id_usuario, $logueado, $isAdmin) {
    $this->smarty->assign('title', $title);
    $this->smarty->assign('acciones', $acciones);
    $this->smarty->assign('regiones', $regiones);
    $this->smarty->assign('user', $user);
    $this->smarty->assign('id_usuario', $id_usuario);
    $this->smarty->assign('logueado', $logueado);
    $this->smarty->assign('isAdmin', $isAdmin);
    $this->smarty->display('./templates/comentarios.tpl');
  }
}