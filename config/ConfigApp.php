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
        'operar' => 'NavController#operar',
        'acerca' => 'NavController#acerca',
        'login' => 'LoginController#login',
        'verify' => 'LoginController#verify',
        'admin' => 'AdminController#adminHome',
        'adminDisplay' => 'AdminController#adminDisplay',
        'acciones' => 'AccionesController#getAll',
        'cotizaciones' => 'AccionesController#getRegion',
        'editar' => 'AccionesController#editAccion',
        'actualizar' => 'AccionesController#updateAccion',
        'insertar' => 'AccionesController#insertAccion',
        'borrar' => 'AccionesController#deleteAccion',
    ];
}
?>