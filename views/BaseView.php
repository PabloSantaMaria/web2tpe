<?php
define('BASE', '//'.$_SERVER['SERVER_NAME'] .':'. $_SERVER["SERVER_PORT"] . dirname($_SERVER['PHP_SELF']).'/');
require_once "./libs/Smarty.class.php";

class BaseView {
  protected $smarty;
  
  /**
   * inicializa template engine Smarty
   * asigna base url para insertar en head de htmls
   */
  function __construct() {
    $this->smarty = new Smarty();
    $this->smarty->assign('baseURL', BASE);
  }
}