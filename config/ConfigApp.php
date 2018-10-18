<?php

define('HOME', 'Location: http://'.$_SERVER["SERVER_NAME"] . dirname($_SERVER["PHP_SELF"]));
define('LOGIN', 'Location: http://'.$_SERVER["SERVER_NAME"] . dirname($_SERVER["PHP_SELF"]). '/login');
define('ADMIN', 'Location: http://'.$_SERVER["SERVER_NAME"] . dirname($_SERVER["PHP_SELF"]). '/admin');
define('TIEMPO_DE_SESION', 1800);

class ConfigApp
{
    public static $ACTION = 'action';
    public static $PARAMS = 'params';
    public static $ACTIONS = [
        '' => 'NavController#home', //página principal
        'home' => 'NavController#home', //página principal
        'acerca' => 'NavController#acerca', //acerca de nosotros
        'cotizaciones' => 'NavController#displayCotizaciones', //cotizaciones visitante
        'login' => 'LoginController#login', //login de admin
        'verify' => 'LoginController#verify', //valida usuario
        'logout' => 'LoginController#logout', //cerrar sesión
        'admin' => 'AdminController#adminHome', //home de admin
        'adminControl' => 'AdminController#adminControl', //opciones de admin
        'editar' => 'AdminController#editAccion', //editar de admin
        'actualizar' => 'AdminController#updateAccion', //actualizar de admin
        'borrar' => 'AdminController#deleteAccion', //borrar de admin
    ];
}
?>