<?php
define('LOCATION', 'Location: http://'.$_SERVER["SERVER_NAME"] .':'. $_SERVER["SERVER_PORT"] . dirname($_SERVER["PHP_SELF"]));
define('HOME', LOCATION);
define('LOGIN', LOCATION . '/login');
define('ADMIN', LOCATION . '/admin');
define('TIEMPO_DE_SESION', 1800);

class ConfigApp
{
    public static $DB = array(
        'dbms' => 'mysql',
        'host' => 'localhost',
        'dbname' => 'tabrokers',
        'username' => 'root',
        'password' => ''
    );
    public static $ACTION = 'action';
    public static $PARAMS = 'params';
    public static $ACTIONS = [
        '' => 'NavController#home', //página principal
        'home' => 'NavController#home', //página principal
        'acerca' => 'NavController#acerca', //acerca de nosotros
        'cotizaciones' => 'NavController#displayCotizaciones', //cotizaciones visitante
        'detalleAccion' => 'NavController#detalleAccion', //ver detalle de acción
        'comentarios' => 'ComentariosController#verComentarios', //ver comentarios
        'login' => 'LoginController#login', //login de admin
        'signIn' => 'LoginController#signIn', //Crear nuevo usuario
        'verify' => 'LoginController#verify', //valida usuario
        'verifyRegister' => 'LoginController#verifyRegister', //valida nuevo usuario
        'logout' => 'LoginController#logout', //cerrar sesión
        'admin' => 'AdminController#adminHome', //home de admin
        'adminControl' => 'AdminController#adminControl', //opciones de admin
        'editar' => 'AdminController#editAccion', //editar de admin
        'actualizar' => 'AdminController#updateAccion', //actualizar de admin
        'borrar' => 'AdminController#deleteAccion', //borrar de admin
        'borrarRegion' => 'AdminController#deleteRegion', //borrar región de admin
    ];
}
?>