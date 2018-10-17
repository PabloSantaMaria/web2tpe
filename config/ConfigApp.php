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
        'login' => 'LoginController#login',
        'verify' => 'LoginController#verify',
        'logout' => 'LoginController#logout',
        'admin' => 'AdminController#adminHome',
        'adminControl' => 'AdminController#adminControl',
        'guardar' => 'AdminController#guardar',
        'editar' => 'AdminController#editAccion',
        'actualizar' => 'AdminController#updateAccion',
        'acciones' => 'AccionesController#getAll',
        'cotizaciones' => 'AccionesController#getRegion',
        'insertar' => 'AccionesController#insertAccion',
        'borrar' => 'AdminController#deleteAccion',
    ];
}
?>