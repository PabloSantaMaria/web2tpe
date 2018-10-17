<?php

define('HOME', 'Location: http://'.$_SERVER["SERVER_NAME"] . dirname($_SERVER["PHP_SELF"]));
define('LOGIN', 'Location: http://'.$_SERVER["SERVER_NAME"] . dirname($_SERVER["PHP_SELF"]). '/login');
define('ADMIN', 'Location: http://'.$_SERVER["SERVER_NAME"] . dirname($_SERVER["PHP_SELF"]). '/admin');

class ConfigApp
{
    public static $ACTION = 'action';
    public static $PARAMS = 'params';
    public static $ACTIONS = [
        '' => 'NavController#home',
        'home' => 'NavController#home',
        'acerca' => 'NavController#acerca',
        'acciones' => 'AccionesController#getAll',
        'cotizaciones' => 'NavController#displayCotizaciones',
        'insertar' => 'AccionesController#insertAccion',
        'login' => 'LoginController#login',
        'verify' => 'LoginController#verify',
        'logout' => 'LoginController#logout',
        'admin' => 'AdminController#adminHome',
        'adminControl' => 'AdminController#adminControl',
        'guardar' => 'AdminController#guardar',
        'editar' => 'AdminController#editAccion',
        'actualizar' => 'AdminController#updateAccion',
        'borrar' => 'AdminController#deleteAccion',
    ];
}
?>